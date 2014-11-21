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
 * Servlet implementation class Edit
 */
public class Edit extends HttpServlet {
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
		
		HttpSession session = request.getSession();
		String login=(String)session.getAttribute("login");
		
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
		String uid=(String)session.getAttribute("uid");
		
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
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
		
		try{
			if(conn!=null){
				qProject=conn.prepareStatement(qString);
				qProject.setInt(1,Integer.parseInt(pid));
				ResultSet user = qProject.executeQuery();
				int flag=0;
				String UserId="";
				while(user.next())
				{
					UserId=user.getString("userid");
					if(UserId.equals(uid)){
						request.setAttribute("uid",user.getString("userid"));
						request.setAttribute("uname",user.getString("name"));
						request.setAttribute("pid",user.getString("project_id"));
						request.setAttribute("pname",user.getString("project_name"));
						request.setAttribute("desc",user.getString("description"));
						if(user.getString("detailed_description")==null)
							request.setAttribute("d_desc","");
						else
							request.setAttribute("d_desc",user.getString("detailed_description"));
						flag=1;
					}
					else{
						request.setAttribute("message", "403 Error . Permission Denied");
						request.getRequestDispatcher("/errors.jsp").forward(request, response);
			            return;
					}
					
				}
				if(flag==0){
					request.setAttribute("message", "No Such Project Found");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}	
			}
			else{
				request.setAttribute("message", "Error Establishing DataBase Connection");
				request.getRequestDispatcher("/errors.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message", "Database error Occured");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
		request.getRequestDispatcher("/WEB-INF/templates/edit-project.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String pid=request.getPathInfo().substring(1);
		PreparedStatement qProject = null;
		String qString = "select * from project,users where users.userid = project.addedby and project_id=?";
		
		String name=(String)request.getParameter("name");
		String desc=(String)request.getParameter("desc");
		String d_desc=(String)request.getParameter("d_desc");
		String tags[]=request.getParameterValues("tags");
		int taglength=tags.length;
		
		
		HttpSession session = request.getSession();
		String login=(String)session.getAttribute("login");
		
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
		String uid=(String)session.getAttribute("uid");
		
		try{
			if(conn!=null){
				qProject=conn.prepareStatement(qString);
				qProject.setInt(1,Integer.parseInt(pid));
				ResultSet user = qProject.executeQuery();
				int flag=0;
				String UserId="";
				while(user.next())
				{
					UserId=user.getString("userid");
					if(UserId.equals(uid)){
						
						qString = "update project set project_name=? , description=? , detailed_description=? where project_id=?";
						qProject=conn.prepareStatement(qString);
						qProject.setString(1, name);
						qProject.setString(2, desc);
						qProject.setString(3, d_desc);
						qProject.setInt(4,Integer.parseInt(pid));
						qProject.executeUpdate();
						
						
						qString = "delete from tagmap where project_id=?";
						qProject=conn.prepareStatement(qString);
						qProject.setInt(1,Integer.parseInt(pid));
						qProject.executeUpdate();
						
						qString = "insert into tagmap values (?,?)";
						for(int i=0;i<taglength;i++){
							qProject=conn.prepareStatement(qString);
							qProject.setString(1, tags[i]);
							qProject.setInt(2,Integer.parseInt(pid));
							qProject.executeUpdate();
						}
						response.sendRedirect(request.getContextPath()+"/project/"+pid);
						return;
						
					}
					else{
						request.setAttribute("message", "403 Error . Permission Denied");
						request.getRequestDispatcher("/errors.jsp").forward(request, response);
			            return;
					}
					
				}
				if(flag==0){
					request.setAttribute("message", "No Such Project Found");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}	
			}
			else{
				request.setAttribute("message", "Error Establishing DataBase Connection");
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

}
