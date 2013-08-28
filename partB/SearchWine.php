
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

$WineName=$_GET['Wine'];
$WineryName=$_GET['Winery'];
$GrapeName=$_GET['Grape'];
$RegionName=$_GET['Region'];
$MinYear=$_GET['YearR1'];
$MaxYear=$_GET['YearR2'];
$MinCost=$_GET['PriceR1'];
$MaxCost=$_GET['PriceR2'];



$WineQuery=mysql_query("SELECT A.wine_name AS WINE_NAME, E.variety AS GRAPE_VARIETY, A.year AS YEAR, B.winery_name AS WINERY_NAME , C.region_name AS REGION, F.cost AS COST, F.on_hand AS IN_STOCK, SUM(G.qty) AS QTY_SOLD, SUM(G.price) AS TOTAL_SALE 
			FROM wine AS A, winery AS B , region AS C, wine_variety AS D, grape_variety AS E, inventory AS F, items AS G 
			WHERE ( (A.winery_id=B.winery_id AND B.region_id=C.region_id AND A.wine_id=D.wine_id AND D.variety_id=E.variety_id AND A.wine_id=F.wine_id AND G.wine_id=A.wine_id) 
				AND (A.wine_name LIKE '$WineName%')
				AND (B.winery_name LIKE '$WineryName%') 
				AND (A.year >= '$MinYear' AND A.year<= '$MaxYear')
				AND (F.cost >= '$MinCost' AND F.cost <= '$MaxCost') 
				OR (E.variety LIKE '$GrapeName')
				OR (C.region_name LIKE '$RegionName')
			      )
		        GROUP BY G.wine_id
	        	ORDER BY A.year");

?>
<title>WINE SEARCH PAGE</title>
<h1 align="center" > <font color="#CCFF00">  </font></h1>
</head>
<body bgcolor="#663333">
<br\>
<?php
echo"<center><table border='1'>
<tr>
<th>WINE NAME</th><th>WINERY NAME</th>
<th>GRAPE VARIETY</th><th>YEAR</th>
<th>REGION</th><th>COST</th>
<th>IN STOCK</th><th>QTY SOLD</th>
<th>TOTAL SALE</th>
</tr></center>";
if(!$WineQuery)
	echo "Result not found";
else
{

 while($row=mysql_fetch_array($WineQuery))
    {
	if($Sold<=$row[QTY_SOLD])
	{ echo "<tr><td>$row[WINE_NAME]</td><td>$row[WINERY_NAME]</td>
	       <td>$row[GRAPE_VARIETY]</td><td>$row[YEAR]</td>
	       <td>$row[REGION]</td><td>$row[COST]</td>
	       <td>$row[IN_STOCK]</td><td>$row[QTY_SOLD]</td> 
               <td>$row[TOTAL_SALE]</td></tr>\n";
	}
   }
}
echo "</table>";
?>
</body>
</html>
