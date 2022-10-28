<HTML>
<HEAD>
<TITLE>payment</TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY>
<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
int rowsAffected,r2;
String str0=request.getParameter("SCNO");
String str1 = request.getParameter("CARDNAME");
String str2 = request.getParameter("CARDNO");
String str3 = request.getParameter("NAME");
int str4 = Integer.parseInt(request.getParameter("MONTH"));
int str5 = Integer.parseInt(request.getParameter("YEAR"));
int str6 = Integer.parseInt(request.getParameter("AC"));
int str7 = Integer.parseInt(request.getParameter("AD"));
Connection c=DriverManager.getConnection("jdbc:odbc:apseb","raghu","project");
Statement smt=c.createStatement();
Statement smt2=c.createStatement();
rowsAffected=smt.executeUpdate("INSERT INTO payment(SCNO,CARDNAME,CARDNO,CARDHOLDER,MONTH,YEAR,AC,AD) values('"+ str0 +"','"+ str1 + "','"+ str2 +"','"+ str3 +"',"+ str4 +","+ str5 +","+ str6 +","+ str7 +")");
r2=smt2.executeUpdate("UPDATE billamount SET AMOUNT=AMOUNT-"+str7+"WHERE SCNO='"+str0+"'");
 
  
if(rowsAffected==1)
{
  %>
	  <h4><center>THE TRANSACTION WAS SUCCESSFUL </h4></center>
  <%
      
}
else
 {
  %>	   


	<h4><center>SORRY,THE TRANSACTION FAILED</center></h4>
	<br>
    <br>
    <center>
    <A HREF ="consumerlogin.html">Click Here To Login And Try Again</A>
    </center>

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

