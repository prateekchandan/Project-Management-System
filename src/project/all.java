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
 * Servlet implementation class all
 */
public class all extends HttpServlet {
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
		PreparedStatement checkStudent = null;
		String checkString = "select * from project,users where users.userid = project.addedby";
		
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
				checkStudent=conn.prepareStatement(checkString);
				ResultSet rs = checkStudent.executeQuery();
				int flag=0;
				while (rs.next()) {
					flag++;
				}
				if(flag==0){
					request.setAttribute("message", "No Projects Found :(");
					request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
		            return;
				}
				else{
					rs = checkStudent.executeQuery();
					request.setAttribute("error","0");
					request.setAttribute("rs",rs);
					request.setAttribute("message", "Browse from " + flag + " Projects");
					request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
		            return;
				}
				
			}
			else
			{
				request.setAttribute("message", "Database Error Occured");
				request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {
			
			request.setAttribute("message", "Some error occured try again2");
			request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
            return;
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request,response);
	}

}
