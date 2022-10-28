<HTML>
<HEAD>
<TITLE> RESULTS </TITLE>
</HEAD>
<BODY>
<%@ page language="java" import="java.sql.*" autoFlush="true" buffer="1kb" %>

<%! String n1,n2,n3,str1,str2,range,hits,prev,next;
    Connection conn1=null,conn2=null;
    Statement st;
    CallableStatement cst;
    int c1,ran1,mins,maxs,ran,my,my1,d1,d2,d3,c2,nos,pageno;
    ResultSet rs; %>
 
<%
  try{
    hits=request.getQueryString();
    if(hits.equals("fir"))
    {
       n1=request.getParameter("DATE");
       n2=request.getParameter("MONTH");
       n3=request.getParameter("YEAR");
       str1= n1+"/"+n2+"/"+n3;
       d1 = Integer.parseInt(request.getParameter("DATE"));
       d2 = Integer.parseInt(request.getParameter("MONTH"));
       d3 = Integer.parseInt(request.getParameter("YEAR"));
       str2 = d1 + "/" + d2 + "/" + d3; 
       range=request.getParameter("range");
       ran1=Integer.parseInt(range);
       ran=Integer.parseInt(range)-1;
       mins=1;
       maxs=mins+ran;
       c2=0;
       pageno=1;
    }      
    else
    {
        
       int ss0=hits.indexOf('~');
       int ss1=hits.indexOf('~',ss0+1);
       int ss2=hits.indexOf('~',ss1+1);
       int ss3=hits.lastIndexOf('~');
       int ss4=hits.indexOf('@');
       pageno=Integer.parseInt(hits.substring(0,ss0));
       n1=hits.substring(ss0+1,ss1);
       n2=hits.substring(ss1+1,ss2);
       n3=hits.substring(ss2+1,ss3);
       str1= n1+"/"+n2+"/"+n3;
       d1=Integer.parseInt(n1);
       d2=Integer.parseInt(n2);
       d3=Integer.parseInt(n3);
       str2 = d1 + "/" + d2 + "/" + d3; 
       range=hits.substring(ss3+1,ss4);
       ran=Integer.parseInt(range)-1;
       ran1=Integer.parseInt(range);
       mins=Integer.parseInt(hits.substring(ss4+1));
       maxs=mins+ran;
       c2=0;
    }
    
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
    conn1=DriverManager.getConnection("jdbc:odbc:ncpl","project","project");
    conn2=DriverManager.getConnection("jdbc:odbc:ncpl","project","project");
    Statement st=conn1.createStatement();
    rs=st.executeQuery("SELECT COUNT(SCNO) AS c FROM BILL WHERE MTRREADDATE = TO_DATE('"+ str2 + "','DD/MM/YY')");
    if(rs.next())
    {
      c1=rs.getInt("c");
      out.flush();
    }
    if(c1==0)
	{
      out.println("<h2><I><center><br><br><br><br><br><br><br>Sorry!No records in this match</center></I></H2>");
	  out.println("click here to go back <a href = report.html><h4>retry<h4>");
    }
    if(c1%ran1!=0)
    {
      nos=(c1/ran1)+1;
     }
    else
	{
      nos=c1/ran1;
    }
	if(c1!=0)
	{%>
    <CENTER>
    <H4> METER READING REPORT </H4>
    <H5> MTR READING DATE: <%= str1 %>  </H5>
    <P>
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Page no:<%=pageno%> </P>
    
    <TABLE BORDER ="1" WIDTH="400">
    <TR>
    <TD><B>SNO</B></TD><TD><B>SCNO</B></TD><TD><B>STATUS</B></TD>
	<TD><B>READING</B></TD><TD><B>UNITS</B></TD>
    </TR>
    <CENTER>

    <%}	for(my=mins;my<=maxs;my++)
	{
	   cst=conn2.prepareCall("{call raghu(?,?,?,?,?,?)}");
	   cst.registerOutParameter(3,java.sql.Types.VARCHAR);
	   cst.registerOutParameter(4,java.sql.Types.INTEGER);
       cst.registerOutParameter(5,java.sql.Types.VARCHAR);
       cst.registerOutParameter(6,java.sql.Types.INTEGER);
	   cst.setString(1,str1);
	   cst.setInt(2,my);
	   cst.execute();
	   c2++;
	   String x1=cst.getString(3);
	   int x2=cst.getInt(4);
	   String x3=cst.getString(5);
           int x4=cst.getInt(6);%>
  
  <TR>
      <TD><%= c2 %></TD>
      <TD><%= x1 %></TD>
      <TD><%= x2 %></TD>
      <TD><%= x3 %></TD>
      <TD><%= x4 %></TD>
  </TR>
      

  <%
       out.flush();
       cst.close();
       if(my==c1)
	   {
	    break;
	   }

	  }
	  conn1.close();
          conn2.close();
   %>
   </TABLE>
   <BR>
  
   
   <% for(my1=1;my1<=nos;my1++)
      {
             String pno=my1+"~"+n1+"~"+n2+"~"+n3+"~"+ran1+"@"+(((my1*(ran+1))+1)-(ran+1));
	         out.println("<a href=finalrep.jsp?"+pno+"> "+my1 + "</a>");
             out.println();
      }
    }
    catch(Exception ex)
    {
     
    }
    
    %>
   </CENTER>
   </BODY>
   </HTML>





        
   


    
                                    
       
       
       
       


     
   