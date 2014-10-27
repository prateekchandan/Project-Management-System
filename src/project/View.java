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

import DB.Conn;

/**
 * Servlet implementation class View
 */
public class View extends HttpServlet {
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
		String pid=request.getPathInfo().substring(1);
		PreparedStatement qProject = null;
		String qString = "select * from project,users where users.userid = project.addedby and project_id=?";
		
		PreparedStatement tags = null;
		String tagst = "select * from tags";
		try{
			if(conn!=null){
				tags=conn.prepareStatement(tagst);
				ResultSet tags_list = tags.executeQuery();
				request.setAttribute("tags",tags_list);
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message", "Some error occured try again");
			request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
            return;
		}
		
		try{
			if(conn!=null){
				qProject=conn.prepareStatement(qString);
				qProject.setInt(1,Integer.parseInt(pid));
				ResultSet user = qProject.executeQuery();
				int flag=0;
				while(user.next())
				{
					request.setAttribute("uid",user.getString("userid"));
					request.setAttribute("uname",user.getString("name"));
					request.setAttribute("pid",user.getString("project_id"));
					request.setAttribute("pname",user.getString("project_name"));
					request.setAttribute("desc",user.getString("description"));
					flag=1;
					
				}
				if(flag==0){
					request.setAttribute("message", "No Such Project Found");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}	
				qString = "select *,start_time::date as date,end_time::date as end_date  from working_on natural join users where  project_id = ?";
				qProject=conn.prepareStatement(qString);
				qProject.setInt(1,Integer.parseInt(pid));
				ResultSet otheruser = qProject.executeQuery();
				request.setAttribute("users",otheruser);
			}
			else{
				request.setAttribute("message", "Error Establishing DataBase Connection");
				request.getRequestDispatcher("/errors.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message", "No Such Project Found");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
		request.getRequestDispatcher("/WEB-INF/templates/project.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
	}

}
