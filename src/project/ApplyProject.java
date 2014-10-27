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
 * Servlet implementation class ApplyProject
 */
public class ApplyProject extends HttpServlet {
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
		HttpSession session=request.getSession();
		String login=(String)session.getAttribute("login");
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
		
		String uid=(String)session.getAttribute("uid");
		String pid=(String)request.getParameter("id");
		if(pid==null){
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
			return;
		}
		PreparedStatement Query = null;
		String qString = "select * from working_on where userid=? and project_id=?";
		try{
			if(conn!=null){
				Query=conn.prepareStatement(qString);
				Query.setString(1, uid);
				Query.setInt(2, Integer.parseInt(pid));
				ResultSet rs=Query.executeQuery();
				if(rs.next()){
					request.setAttribute("message", "Error: You are Already Working on this Project");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}
				qString = "insert into working_on values(?,?,'applied',current_timestamp,NULL,'')";
				Query=conn.prepareStatement(qString);
				Query.setString(1, uid);
				Query.setInt(2, Integer.parseInt(pid));
				Query.executeUpdate();
				
				response.sendRedirect(request.getContextPath()+"/project/"+pid);
			}
			else{
				request.setAttribute("message", "Database conenction error");
				request.getRequestDispatcher("/errors.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message", ex.getMessage());
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		request.getRequestDispatcher("/errors.jsp").forward(request, response);
        return;
	}

}
