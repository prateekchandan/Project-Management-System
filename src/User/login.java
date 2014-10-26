package User;

import java.io.IOException;
import java.io.PrintWriter;
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
 * Servlet implementation class login
 */
public class login extends HttpServlet {
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
		if(login == "1")
		{
			response.sendRedirect(request.getContextPath());
			return;
		}
		
		response.setContentType("text/html");
	    request.getRequestDispatcher("/login.jsp").forward(request, response);
	}	

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String name,password,passchk = null;
		name=request.getParameter("uid");
		password=(String)request.getParameter("password");
		
		if(name == null || name=="" || password == null|| password == ""){
			 request.setAttribute("message", "Username or password not set");
			 request.getRequestDispatcher("/login.jsp").forward(request, response);
			 return;
		}
		PreparedStatement checkStudent = null;
		String checkString = "select * from users where userid=? or email=?";
		try{
			
			if(conn!=null){
				checkStudent=conn.prepareStatement(checkString);
				checkStudent.setString(1,name);
				checkStudent.setString(2,name);
				ResultSet rs = checkStudent.executeQuery();
				int flag=0;
				while (rs.next()) {
					flag=1;
					passchk=(String)rs.getString("password");
					if(password==passchk || (password!=null && password.equals(passchk))){
						HttpSession session = request.getSession();
						session.setAttribute("login","1");
						String uname=rs.getString("name"),email=rs.getString("email"),uid=rs.getString("userid");
						session.setAttribute("user_name",uname);
						session.setAttribute("email",email);
						session.setAttribute("uid",uid);
						response.sendRedirect(request.getContextPath()+"/login");
						return;
					}
				}
				if(flag==0)
				{
					request.setAttribute("message", "Username or email not found");
					request.getRequestDispatcher("/login.jsp").forward(request, response);
					return;
				}
				else{
					request.setAttribute("message", "Password not matched");
					request.getRequestDispatcher("/login.jsp").forward(request, response);
					return;
				}
			}
			else
			{
				request.setAttribute("message", "Database Error");
				request.getRequestDispatcher("/login.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {
			
			request.setAttribute("message", "Some error occured try again"+ex.getLocalizedMessage());
			request.getRequestDispatcher("/login.jsp").forward(request, response);
            return;
		}
		
	}

}
