<HTML>
<HEAD>
<TITLE>REGISTRATION </TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY>
<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
int rowsAffected;
String str1 = request.getParameter("userid");
String str2 = request.getParameter("password");
String str3 = request.getParameter("gender");
String str2 = request.getParameter("age");
String str2 = request.getParameter("glasses");
String str2 = request.getParameter("colorblind");
String str2 = request.getParameter("comments");
Connection c = DriverManager.getConnection("jdbc:odbc:apseb","raghu","project");
Statement smt=c.createStatement();
rowsAffected =smt.executeUpdate("INSERT INTO consumer(SCNO,PASSWORD) values ('"+ str1 +"','"+ str2 + "')");
if(rowsAffected==1)
{
  %>
  <h4><center>YOU HAVE BEEN REGISTERED</h4></center>
  <a href=consumerlogin.html><u><center>Click Here To Login</center></u></a>
 <%
      
}
else
 {
  %>	   
	<h4>SORRY, ADDITION HAS FAILED</h4>
	<br>
    <br>
    <center>
    <A HREF ="consumerregister.html">Click Here To Try Again</A>
    </center>

  <%
 }
   smt.close();
   c.close();
}


catch(Exception ex)
{
  out.println(ex);
}

%>
</BODY>
</HTML>


