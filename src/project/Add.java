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
 * Servlet implementation class Add
 */
public class Add extends HttpServlet {
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
		HttpSession session = request.getSession();
		String login=(String)session.getAttribute("login");
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
			request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
            return;
		}
		if(login!=null && login.equals("1")){
			
			request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
		}
		else{
			request.setAttribute("message", "Error : Please Login to add project");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String name=(String)request.getParameter("name");
		String desc=(String)request.getParameter("desc");
		String tags[]=request.getParameterValues("tags");
		int taglength=tags.length;
		
		HttpSession session = request.getSession();
		String login=(String)session.getAttribute("login");
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
		
		String uid=(String)session.getAttribute("uid");
		if(name==null || name=="" || desc == null || desc==""){
			request.setAttribute("message", "Name or Description Missing");
			request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
			return;
		}
		if(taglength==0){
			request.setAttribute("message", "Add ateast one tag to this project");
			request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
			return;
		}
		
		PreparedStatement Query = null;
		String qString = "insert into project(project_name,description,addedby,status) values (?,?,?,'in progress')";
		try{
			if(conn!=null){
				Query=conn.prepareStatement(qString,PreparedStatement.RETURN_GENERATED_KEYS);
				Query.setString(1, name);
				Query.setString(2, desc);
				Query.setString(3, uid);
				Query.executeUpdate();
				ResultSet rs=Query.getGeneratedKeys();
				int id=-1;
				if(rs!=null && rs.next()){
					id=rs.getInt(1);
				}
				if(id==-1){
					request.setAttribute("message", "Unable to insert Project");
					request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
					return;
				}
				
				qString = "insert into tagmap values (?,?)";
				for(int i=0;i<taglength;i++){
					Query=conn.prepareStatement(qString);
					Query.setString(1, tags[i]);
					Query.setInt(2, id);
					Query.executeUpdate();
				}
				response.sendRedirect(request.getContextPath()+"/project/"+id);
				return;
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message",  ex.getMessage());
			request.getRequestDispatcher("/WEB-INF/templates/project_add.jsp").forward(request, response);
			return;
		}
		
	}

}
