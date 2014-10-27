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
 * Servlet implementation class TagAdd
 */
public class TagAdd extends HttpServlet {
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
		if(login!=null && login.equals("1")){
			request.getRequestDispatcher("/WEB-INF/templates/add-tag.jsp").forward(request, response);
		}
		else{
			response.setContentType("text/html");
		    request.getRequestDispatcher("/login.jsp").forward(request, response);
		}
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
		
		
		String name=(String)request.getParameter("tagname");
		String url=(String)request.getParameter("returl");
		if(url==null)
			url=request.getContextPath()+"/";
		PreparedStatement tags = null;
		String tagst = "select * from tags where tagname=?";
		try{
			if(conn!=null){
				tags=conn.prepareStatement(tagst);
				tags.setString(1, name);
				ResultSet rs = tags.executeQuery();
				int flag=0;
				while(rs.next()){
					flag=1;
				}
				if(flag==0)
				{
					tagst = "insert into tags values (?)";
					tags=conn.prepareStatement(tagst);
					tags.setString(1, name);
					tags.executeUpdate();
				}
				
			}
			response.sendRedirect(url);
			return;
		}
		catch (SQLException ex) {	
			request.setAttribute("message", "Some error occured try again");
			request.getRequestDispatcher("/errors.jsp").forward(request, response);
            return;
		}
	}

}
