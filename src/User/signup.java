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
 * Servlet implementation class signup
 */
public class signup extends HttpServlet {
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
	    request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String name,password,email,uid,institute,roll,utype,phone;
		name=request.getParameter("name");
		uid=request.getParameter("uid");
		email=request.getParameter("email");
		utype=request.getParameter("utype");
		password=request.getParameter("password");
		phone=request.getParameter("phone");
		institute=request.getParameter("institute");
		roll=request.getParameter("roll");
		
		if(name==null || name==""){
			request.setAttribute("message", "Name not Present");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
			return;	
		}
		
		if(uid==null || uid==""){
			request.setAttribute("message", "UserId Missing");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
			return;	
		}
		
		if(email==null || email==""){
			request.setAttribute("message", "Email Missing");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
			return;	
		}
		if(password==null || password==""){
			request.setAttribute("message", "Password Miss");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
		}
		if(utype==null ||utype==""){
			request.setAttribute("message", "User Type not specified");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
		}
		PreparedStatement checkStudent = null;
		String checkString = "select * from users where userid=? or email=?";
		
		try{
			
			if(conn!=null){
				checkStudent=conn.prepareStatement(checkString);
				checkStudent.setString(1,uid);
				checkStudent.setString(2,email);
				ResultSet rs = checkStudent.executeQuery();
				int flag=0;
				while (rs.next()) {
					flag=1;
				}
				if(flag==1)
				{
					request.setAttribute("message", "Username or email already present");
					request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
					return;
				}
				else{
					checkString = "insert into users values(?,?,?,?,?,?,?,?)";
					checkStudent=conn.prepareStatement(checkString);
					checkStudent.setString(1,uid);
					checkStudent.setString(2,name);
					checkStudent.setString(3,password);
					checkStudent.setString(4,roll);
					checkStudent.setString(5,phone);
					checkStudent.setString(6,email);
					checkStudent.setString(7,institute);
					checkStudent.setString(8,utype);
					checkStudent.executeUpdate();
					HttpSession session = request.getSession();
					session.setAttribute("login","1");
					session.setAttribute("name",name);
					session.setAttribute("email",email);
					session.setAttribute("uid",uid);
					response.sendRedirect(request.getContextPath()+"/signup");
					return;
				}
			}
			else
			{
				request.setAttribute("message", "Some error occured try again");
				request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
	            return;
			}
		}
		catch (SQLException ex) {
			
			request.setAttribute("message", "Some error occured try again");
			request.getRequestDispatcher("/WEB-INF/templates/signup.jsp").forward(request, response);
            return;
		}
		
		
	}

}
