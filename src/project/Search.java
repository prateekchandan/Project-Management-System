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
 * Servlet implementation class Search
 */
public class Search extends HttpServlet {
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
		String q=(String)request.getParameter("q");
		
		if(q==null){
			response.sendRedirect(request.getContextPath()+"/projects");
		}
		
		String qar[]=q.split(" ");
		String qor="",qinit=q;
		qinit= "\"" + qinit + "\"";
		q="";
		for(int i=0;i<qar.length;i++)
		{
			if(i!=0){
				q=q+" & "+qar[i];
				qor=qor+" | "+qar[i];
			}
			else{
				q=qar[i];
			}
		}
		
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
		PreparedStatement checkStudent = null;
		String checkString = "select * from project,users where users.userid = project.addedby and project_id in (select pid from (select project.project_id as pid, (to_tsvector(project.project_name)||to_tsvector(description) || to_tsvector(tagname)) as document from project natural join tagmap) p_search where p_search.document @@ to_tsquery(?) )";
		
		try{
			
			if(conn!=null){
				checkStudent=conn.prepareStatement(checkString);
				checkStudent.setString(1,q);
				ResultSet rs = checkStudent.executeQuery();
				int flag=0;
				while (rs.next()) {
					flag++;
				}
				if(flag==0){
					request.setAttribute("message", "No Projects Found for string "+qinit);
					request.getRequestDispatcher("/WEB-INF/templates/project_all.jsp").forward(request, response);
		            return;
				}
				else{
					rs = checkStudent.executeQuery();
					request.setAttribute("error","0");
					request.setAttribute("rs",rs);
					request.setAttribute("message", "Browse from " + flag + " Projects for "+qinit);
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
			
			request.setAttribute("message", ex.getMessage());
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
