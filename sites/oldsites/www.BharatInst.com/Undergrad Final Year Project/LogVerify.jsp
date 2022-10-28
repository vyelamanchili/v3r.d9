<HTML>
<HEAD>
<TITLE>WELCOME </TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY BGCOLOR="#FFFFF">
<%! int count=0; %>

<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
String str1 = request.getParameter("uname");
String str2 = request.getParameter("pwd");
String str;
Connection c=DriverManager.getConnection("jdbc:odbc:apseb","raghu","project");
Statement smt=c.createStatement();
ResultSet rs=smt.executeQuery("SELECT PASSWORD AS P FROM LOGIN WHERE USERNAME='"+str1+"'");
if(count>=2)
{
  response.sendRedirect("http://ncpl8:8080/project/loginfail.html");
}

if(rs.next())
 {
   str=rs.getString("P");
   if (str.equals(str2))
    {
     response.sendRedirect("http://ncpl8:8080/project/main.html");
    }
    else 
	{
	 count++;
	 %>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <center>
	 <h4> Sorry, Your Login Failed.</h4>
	 <a href=login.html><u>Click Here To Try Again</u></a></center>
	 <%
    }
	
  }
else 
 {
	 count++;

	 %>
	<br>
	<br>
	<br>
	<br>
	<center>
	<h4> Sorry, Your Login Failed.</h4>
	<a href=login.html><u>Click Here To Try Again</u> </a></center>
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


