package DB;
import java.sql.Connection;
import java.sql.DriverManager;


public class Conn {
	public Connection con;
	public Conn() {
		String dbURL2 = "jdbc:postgresql://localhost/pms";
	    String user = "prateek";
	    String pass = "9431221178";
	    try {
			Class.forName("org.postgresql.Driver");
		
			con = DriverManager.getConnection(dbURL2, user, pass);
			System.out.println("init"+con);
      	} catch (Exception e) {
			// TODO Auto-generated catch block
      		e.printStackTrace();
      	}
	 }
}
