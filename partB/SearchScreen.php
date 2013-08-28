<html>
<head>

<title>WINE SEARCH PAGE</title>
<h1 align="center" > <font color="#CCFF00"> Search Your Wine </font></h1>
</head>
<body bgcolor="#663333">
<form id="form1" name="form1" method="post" action="SearchWine.php">
<center>
  <p>
    <label><font color="#33FF33"><br />
    <br />
 <br />
    <br />
    <b>WINE NAME:</b> </font>
    <input type="text" name="WineName" />
    </label>
  </p>
  <p>
    <label> <font color="#33FF33"><b> WINERY NAME: </b></font>
    <input type="text" name="WineryName" />
    </label>
  </p>
  <p>

    <label><font color="#33FF33"><b>YEAR RANGE:</b></font>
    <select name="YearR1">
    <option value="">--MIN--</option>
    <?
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

 $YearQuery=mysql_query("SELECT DISTINCT 'year' FROM 'wine' ORDER BY 'year'");
while($row=mysql_fetch_array($YearQuery))
        <option value='$row[year]'>$row[year]</option>"\n";
?>

</select>
        &nbsp;&nbsp;
 <select name="YearR2">
    </select>
        </label>
  </p>
  <p>
    <label><font color="#33FF33"><b>PRICE RANGE:</b></font>
    <select name="PriceR1">
    </select>
        &nbsp;&nbsp;
    <select name="PriceR2">
    </select>
          </label>
  </p>
  <p>
    <label><font color="#33FF33"><b>NO. OF WINES AVAILABLE:</b></font>
    <input type="text" name="WinesAvail" />
    </label>
</p>
  <p>
    <label><font color="#33FF33"><b>NO. OF WINES ORDERED:</b></font>
    <input type="text" name="WinesOrder" />
    </label>
  </p>
  <p>
    <input type="submit" name="Submit" value="SEARCH" />
   </p>
  </center>
</form>
</body>
</html>

