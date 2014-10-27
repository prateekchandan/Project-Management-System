package project;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import DB.Conn;

/**
 * Servlet implementation class SaveRemark
 */
public class SaveRemark extends HttpServlet {
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
		request.getRequestDispatcher("/errors.jsp").forward(request, response);
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
		String user=(String)request.getParameter("uid");
		String remark=(String)request.getParameter("remarks");
		System.out.println(pid);
		if(pid == null || remark == null || user==null){
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
						qString = "update working_on set remarks=? where userid=? and project_id=?";
						Query=conn.prepareStatement(qString);
						Query.setString(1,remark);
						Query.setString(2, user);
						Query.setInt(3, Integer.parseInt(pid));
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
