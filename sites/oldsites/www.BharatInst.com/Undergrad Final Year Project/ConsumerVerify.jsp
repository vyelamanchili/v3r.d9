<HTML>
<HEAD>
<TITLE>PAYMENT </TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY BGCOLOR="#FFFFF">
<%! int count=0,y;
    String x; %>

<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
String str1 = request.getParameter("scno");
String str2 = request.getParameter("pwd");
String str;
Connection c=DriverManager.getConnection("jdbc:odbc:apseb","raghu","project");
Statement smt=c.createStatement();
Statement smt2=c.createStatement();
ResultSet rs=smt.executeQuery("SELECT PASSWORD AS P FROM consumer WHERE SCNO='"+str1+"'");

if(count>=2)
{
  response.sendRedirect("http://127.0.0.1:8080/project/loginfail.html");
}

if(rs.next())
 {
   str=rs.getString("P");
   if (str.equals(str2))
    {
      ResultSet myResultSet=smt2.executeQuery("SELECT AMOUNT FROM billamount WHERE SCNO='"+str1+"'");
      if(myResultSet.next())
      {
       y=myResultSet.getInt("AMOUNT");
       response.sendRedirect("http://127.0.0.1:8080/project/online.htm?"+str1+"&"+y);
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
	 <br>
	 <br>
	 <center>
	 <h4> Sorry, Your Login Failed.</h4>
	 <a href=consumerlogin.html><u>Click Here To Try Again</u></a></center>
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
	<a href=consumerlogin.html><u>Click Here To Try Again</u> </a></center>
	<%
 }



smt.close();
smt2.close();
c.close();
 }

catch(Exception ex)
{
  out.println(ex);
}
 %>
</BODY>
</HTML>


