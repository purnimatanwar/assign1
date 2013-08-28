<html>
<head>
<?php
$username = "webadmin";
$password = "Pur111990";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect("localhost","webadmin", "Pur111990");
if(!$dbhandle)
{
 die("Unable to connect to MySQL");
}

$selected = mysql_select_db("winestore",$dbhandle)
  or die("Could not select winestore");

$GrapeVariety=mysql_query("SELECT variety FROM grape_variety ORDER BY variety");
$RegionQuery=mysql_query("SELECT region_name FROM region ORDER BY region_id");
$YearQuery1=mysql_query("SELECT DISTINCT year FROM wine ORDER BY year");
$YearQuery2=mysql_query("SELECT DISTINCT year FROM wine ORDER BY year");
$PriceQuery1=mysql_query("SELECT DISTINCT FLOOR(cost) AS PRICE FROM inventory ORDER BY FLOOR(cost)");
$PriceQuery2=mysql_query("SELECT DISTINCT FLOOR(cost) AS PRICE FROM inventory ORDER BY FLOOR(cost)");
?>

<title>WINE SEARCH PAGE</title>
<h1 align="center" > <font color="#CCFF00"> Search Your Wine </font></h1>
</head>
<body bgcolor="#663333">
<form id="form1" name="form1" method="GET" action="SearchWine.php" >
<center>
  <p>
    <label><font color="#33FF33"><br />
    <br />
 <br />
    <br />
    <b>WINE NAME:</b> </font>
    <input type="text" name="Wine" placeholder=" full name or part of it "/>
    </label>
  </p>
  <p>
    <label> <font color="#33FF33"><b> WINERY NAME: </b></font>
    <input type="text" name="Winery" placeholder="full name or part of it"/>
    </label>
  </p>
 <p>
 <label> <font color="#33FF33"><b> GRAPE VARIETY:</b><font>
   <select name="Grape">
    <?php
        while($row=mysql_fetch_array($GrapeVariety))
        echo"<option value='$row[variety]'>$row[variety]</option>\n";
  ?>
</select>
</label>
</p>
 <p>
 <label> <font color="#33FF33"><b> REGION:</b><font>
   <select name="Region">
    <?php
        while($row=mysql_fetch_array($RegionQuery))
        echo"<option value='$row[region_name]'>$row[region_name]</option>\n";
  ?>
</select>
</label>
</p>
  <p>
    <label><font color="#33FF33"><b>YEAR RANGE:</b></font>
     <label><font color="#33FF33"><b>MIN:</b></font></label>
    <select name="YearR1">
<?php
 
	while($row=mysql_fetch_array($YearQuery1))
        echo"<option value='$row[year]'>$row[year]</option>\n";
  ?>
     </select>
     </label>
	 <label><font color="#33FF33"><b>MAX:</b></font></label>
     <label>
     <select name="YearR2">
<?php
         while($row=mysql_fetch_array($YearQuery2))
        echo"<option value='$row[year]'>$row[year]</option>\n";
?>
    
   </select>
   </label>
  </p>
  <p>
    <label><font color="#33FF33"><b>PRICE RANGE:</b></font>
    <label><font color="#33FF33"><b>MIN:</b></font></label>
    <select name="PriceR1">
 <?php
	 while($pricerow=mysql_fetch_array($PriceQuery1))
        echo"<option value='$pricerow[PRICE]'>$pricerow[PRICE]</option>\n";
?>
    </select>
    </label>
     <label><font color="#33FF33"><b>MAX:</b></font></label>
    <label>
    <select name="PriceR2">
     <?php
     	while($pricerow=mysql_fetch_array($PriceQuery2))
        echo"<option value='$pricerow[PRICE]'>$pricerow[PRICE]</option>\n";
?>
    </select>
    </label>
  </p>
  <p>
    <label><font color="#33FF33"><b>NO. OF WINES REQUIRED:</b></font>
    <input type="text" name="Available" value="0" />
    </label>
</p>
  <p>
    <label><font color="#33FF33"><b>NO. OF WINES ORDERED:</b></font>
    <input type="text" name="Ordered" value="0" />
    </label>
  </p>
  <p>
    <input type="submit" name="Submit" value="SEARCH" />
   </p>
  </center>
</form>
</body>
</html>

