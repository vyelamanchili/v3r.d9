Professional JSP Source Code
****************************
Parts of the source code:
*************************

3625.zip - Main source code download, including:
  Projsp.war - the web application - everything's included
  Projsp.jar - the source code which you can build for Tomcat using Ant
3625_Ch14.zip - the photoDB case study, as a web application
3625_Ch17.zip - the J2EE case study, on its own
3625_Ch19.zip - the weather case study, on its own


Reading the JAR and WAR files:
******************************

The JAR and WAR files (Projsp.jar and Projsp.war) are, in effect, just ZIP files, and
can be opened and viewed using WinZip or any other similar tool.


Setup: 
******
This source code has been tested with Jakarta Tomcat 3.1, and JDK 1.2.2 on an NT box

See http://java.sun.com and http://jakarta.apache.org

The basic environment variables are:

set PATH=%PATH%;c:\jdk1.2.2\bin;c:\java\jakarta-tomcat\bin
set JAVA_HOME=c:\jdk1.2.2
set CLASSPATH=.;c:\jdk1.2.2\jre\lib\rt.jar;
                c:\jdk1.2.2\lib\tools.jar;
                c:\java\jakarta-tomcat\lib\servlet.jar
set ANT_HOME=c:\java\jakarta-ant


Additional Setup by Chapter:
****************************
7
  MySQL: 	http://www.mysql.com/
  JDBC drivers: http://www.worldserver.com/mm.mysql/
  PoolMan: 	http://www.codestudio.com/PoolMan/index.shtml

  Database:	empdir.mdb
		sql/createdb.sql and sql/addat.sql

  Additions to the CLASSPATH:
  c:\java\Poolman-1.3.7\lib\PoolMan.jar
  c:\java\Poolman-1.3.7\lib
  c:\java\mysql_jdbcDriverDirectory

  The second entry is needed to access pool.props

8
  Database: 	books.mdb

11
  Database:	sql/create-settingsdb.sql

14
  Database: 	sql/create-mysql.sql and sql/sample-mysql.sql
		sql/create-pgsql.sql and sql/sample-pgsql.sql
		use the mksql script to generate the script for your DB

  Additions to the CLASSPATH:
  c:\projsp\lib\mcutil.jar

  Needed to allow compilation of the other classes

18
  JMF: 		http://java.sun.com/products/java-media/jmf/index.html
  Pushlet info:	http://www.justobjects.nl/

  Additions to the CLASSPATH:
  c:\PROGRA~1\JMF2.0\lib\jmf.jar
  c:\PROGRA~1\JMF2.0\lib\sound.jar

19
  WAP browser:	http://www.phone.com/index.html
  XT:	 	http://www.jclark.com/xml
  JAXP: 	http://java.sun.com/xml

  Database:	MyNa.mdb

  Additions to the CLASSPATH:
  c:\java\xt\xt.jar
  c:\java\jaxp1.0.1\jaxp.jar
  c:\java\jaxp1.0.1\parser.jar
  c:\java\jakarta-tomcat\webapps\projsp\web-inf\classes

  This last one is needed so that XT can see the stylesheets that it'll use.

E
  Database:	country.mdb 