<HTML>
<HEAD>
<TITLE>ADDING A RECORD </TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY>
<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
int rowsaffected,str3;
String str1 = request.getParameter("SCNO");

int d1 = Integer.parseInt(request.getParameter("DATE"));
int d2 = Integer.parseInt(request.getParameter("MONTH"));
int d3 = Integer.parseInt(request.getParameter("YEAR"));
String str2 = d1 + "/" + d2 + "/" + d3; 
String s=request.getParameter("READING");
int str4 = Integer.parseInt(request.getParameter("STATUS"));
int str5 = Integer.parseInt(request.getParameter("UNITS"));
Connection c=DriverManager.getConnection("jdbc:odbc:project","project","project");
Statement smt=c.createStatement();
if(s.length()!=0)
{
   str3 = Integer.parseInt(request.getParameter("READING"));
   rowsaffected =smt.executeUpdate("INSERT INTO bill(SCNO,MTRREADDATE,READING,STATUS,UNITS) values('"+ str1 +"',TO_DATE('"+ str2 + "','DD/MM/YY'),"+ str3 +","+ str4 +","+ str5 +")");
}
else
{
   rowsaffected =smt.executeUpdate("INSERT INTO bill(SCNO,MTRREADDATE,STATUS,UNITS) values('"+ str1 +"',TO_DATE('"+ str2 + "','DD/MM/YY'),"+ str4 +","+ str5 +")");
}
 
  
if(rowsaffected==1)
{
  %>
	  <h2><center>SUCCESSFUL ADDITION</h2></center>
	  
  <%
    response.sendRedirect("http://ncpl8:8080/project/exBILL.HTML");
  %>

 <%
      
}
 else
 {
  %>	   


	<h1>SORRY, ADDITION HAS FAILED</h1>
	<br>
    <br>
    <center>
    <A HREF ="exBILL.HTML">Click Here To Enter Another Record</A>
    </center>

  <%
 }
	smt.close();
   c.close();
}
catch(SQLException e)
{
 out.println("THE ENTERED SCNO PROBABLY EXISTS. <br>  TRY GIVING ANOTHER SCNO.");
}

catch(Exception ex)
{
  out.println(ex);
}

 %>


</BODY>
</HTML>

