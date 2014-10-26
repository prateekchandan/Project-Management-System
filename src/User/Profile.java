package User;

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
 * Servlet implementation class Profile
 */
public class Profile extends HttpServlet {
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
		String uid=request.getPathInfo().substring(1);
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
					request.getRequestDispatcher("/errors.jsp").forward(request, response);
		            return;
				}
				
				qString = "select * from skills where userid=?";
				qUser=conn.prepareStatement(qString);
				qUser.setString(1,uid);
				ResultSet skills = qUser.executeQuery();
				request.setAttribute("skills",skills);
				
				qString = "select * from project where addedby = ?";
				qUser=conn.prepareStatement(qString);
				qUser.setString(1,uid);
				ResultSet ownprojects = qUser.executeQuery();
				request.setAttribute("ownprojects",ownprojects);
			}
		}
		catch (SQLException ex) {	
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
		request.getRequestDispatcher("/WEB-INF/templates/user.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}

}
