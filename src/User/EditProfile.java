package User;

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
 * Servlet implementation class EditProfile
 */
public class EditProfile extends HttpServlet {
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
		    return;
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
		
		PreparedStatement qUser = null;
		String qString = "select * from users where userid=?";
		
		try{
			if(conn!=null){
				qUser=conn.prepareStatement(qString);
				qUser.setString(1,uid);
				ResultSet user = qUser.executeQuery();
				int flag=0;
				while(user.next())
				{
					flag=1;
					request.setAttribute("uid",user.getString("userid"));
					request.setAttribute("name",user.getString("name"));
					request.setAttribute("email",user.getString("email"));
					request.setAttribute("utype",user.getString("type"));
					request.setAttribute("phone",user.getString("phone"));
					request.setAttribute("institute",user.getString("institute"));
					request.setAttribute("roll",user.getString("roll_number"));
				}
				if(flag==0){
					request.setAttribute("message", "Unable to find user");
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}
			}
		}
		catch (SQLException ex) {	
			request.setAttribute("message",ex.getMessage());
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
		request.getRequestDispatcher("/WEB-INF/templates/user-edit.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session=request.getSession();
		String login=(String)session.getAttribute("login");
		if(!(login!=null && login.equals("1"))){
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		    return;
		}
		String uid=(String)session.getAttribute("uid");
		
		String name=(String)request.getParameter("name");
		String email=(String)request.getParameter("email");
		String phone=(String)request.getParameter("phone");
		String institute=(String)request.getParameter("institute");
		String utype=(String)request.getParameter("utype");
		String roll=(String)request.getParameter("roll");
		
		String tags[]=request.getParameterValues("tags");
		int taglength=tags.length;
		
		if(name==null || name=="" || email=="" || email == null || phone==null || institute==null){
			request.setAttribute("message", "Some data not Present");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
			return;	
		}
		
		PreparedStatement stmt = null;
		String Query = "update users set name=? , email=? , phone=? , institute=? , type=? , roll_number=? where userid=? ";
		
		try{
			if(conn!=null){
				stmt=conn.prepareStatement(Query);
				stmt.setString(1,name);
				stmt.setString(2,email);
				stmt.setString(3,phone);
				stmt.setString(4,institute);
				stmt.setString(5,utype);
				stmt.setString(6,roll);
				stmt.setString(7,uid);
				stmt.executeUpdate();
				
				Query = "delete from skills where userid=?";
				stmt=conn.prepareStatement(Query);
				stmt.setString(1,uid);
				stmt.executeUpdate();
				
				Query = "insert into skills values (?,?)";
				for(int i=0;i<taglength;i++){
					stmt=conn.prepareStatement(Query);
					stmt.setString(1,uid);
					stmt.setString(2, tags[i]);
					stmt.executeUpdate();
				}
				
				response.sendRedirect(request.getContextPath()+"/user/"+uid);
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
