<HTML>
<HEAD>
<TITLE>Search Results </TITLE>
</HEAD>
<%@ page language = "java" import="java.sql.*" %>
<BODY>
<CENTER>

<H4>METER READING REPORT </H4></CENTER>

<BR>
	 
<%
try{

Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
int c2,count=0,c3;
String c1;
String n1=request.getParameter("RNAME");
Connection c=DriverManager.getConnection("jdbc:odbc:project","project","project");
Statement smt=c.createStatement();
Statement smt1=c.createStatement();
ResultSet my1=smt.executeQuery("SELECT TO_CHAR(MTRREADDATE,'DD/MM/YY') AS c,RECORDS FROM REPORT WHERE RNAME = '"+n1+"'");

 if(my1.next())
    {
      c1=my1.getString("c");
	  c2=my1.getInt("RECORDS");

	  
%>
<CENTER>
 <H4> REPORT NAME: <%= n1 %> </H4>
 <H5>MTR READING DATE: <%= c1 %>  </H5>


<% 
	  ResultSet my2 =smt1.executeQuery("SELECT SCNO,STATUS,READING,UNITS FROM BILL WHERE MTRREADDATE = TO_DATE('"+c1+ "','DD/MM/YY')");
%> 
 <TABLE BORDER ="1" WIDTH="400">
 <TR>
    <TD><B>SLNO</B><TD><B>SCNO</B></TD><TD><B>STATUS</B></TD>
	<TD><B>READING</B></TD><TD><B>UNITS</B></TD>
 </TR>
<%
 
  if(my2!=null)
  {
 
   while (my2.next() && count < c2){
    
    String s1=my2.getString("SCNO");
    String s2=my2.getString("STATUS");
    String s3=my2.getString("READING");
    String s4=my2.getString("UNITS");
	count++;
  %>


  <TR>
      
	  <TD><%= count%></TD>
      <TD><%= s1 %></TD>
      <TD><%= s2 %></TD>
      <TD><%= s3 %></TD>
      <TD><%= s4 %></TD>
  </TR>

 <% 
    }
  }

   if(c2==0)
   {
    out.println("THERE ARE NO RECORDS IN THIS REPORT");
	out.println();
   }


 }

else
    {
      out.println("THERE IS NO REPORT WITH THIS NAME");
    }

   smt1.close();   
   smt.close();
   c.close();
   

}

catch(Exception ex)
{
  out.println(ex);
}

 %>
</TABLE>
</CENTER>

</BODY>
</HTML>

