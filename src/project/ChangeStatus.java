package project;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import DB.Conn;

/**
 * Servlet implementation class ChangeStatus
 */
public class ChangeStatus extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
	Connection conn;
	public void init() throws ServletException{
		Conn con=new Conn();
    	conn=con.con;
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doPost(request,response);
        return;
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession();
		String login=(String)session.getAttribute("login");
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
		String uid=(String)session.getAttribute("uid");
		String pid=(String)request.getParameter("pid");
		String user=(String)request.getParameter("user");
		String action=(String)request.getParameter("action");
		if(pid == null || action == null || user==null){
			request.setAttribute("message", "Null Value Occured");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
	        return;
		}
		
		PreparedStatement Query = null;
		String qString = "select addedby from project where project_id=?";
		try{
			if(conn!=null){
				Query=conn.prepareStatement(qString);
				Query.setInt(1, Integer.parseInt(pid));
				ResultSet rs=Query.executeQuery();
				if(rs.next()){
					String added=(String)rs.getString("addedby");
					if(added!=null && added.equals(uid)){
						if(action.equals("delete")){
							qString = "delete from working_on where userid=? and project_id=?";
						}
						else if(action.equals("accept")){
							qString = "update working_on set status='working' where userid=? and project_id=?";
						}
						else if(action.equals("hold")){
							qString = "update working_on set status='hold' where userid=? and project_id=?";
						}
						else if(action.equals("end"))
						{
							qString = "update working_on set status='completed' , end_time=current_timestamp where userid=? and project_id=?";
						}
						else{
							request.setAttribute("message", "Unrecognized Action");
							request.getRequestDispatcher("/errors.jsp").forward(request, response);
							return;
						}
						Query=conn.prepareStatement(qString);
						Query.setString(1, user);
						Query.setInt(2, Integer.parseInt(pid));
						Query.executeUpdate();
						response.sendRedirect(request.getContextPath()+"/project/"+pid);
						return;
					}
					else{
						request.setAttribute("message", "No Project Found");
						request.getRequestDispatcher("/errors.jsp").forward(request, response);
						return;
					}
				}
				else{
					request.setAttribute("message", "No Project Found");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
					return;
				}
			}
			else
			{
				request.setAttribute("message", "Error Occured");
				request.getRequestDispatcher("/errors.jsp").forward(request, response);
				return;
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message",  ex.getMessage());
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
			return;
		}
	}

}
