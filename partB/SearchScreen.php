<html>
 <head>
  <?php
	if(isset($_GET['Submit']))
	{
 		if($_GET['YearR1']>=$_GET['YearR2'])
		{
 	 		echo "Enter valid range for date";  
        	}
 		else
                {
	 		if($_GET['PriceR1']>=$_GET['PriceR2'])
        		{
         			echo "Enter valid range for price";
        		}
			else
        		{ 
	 			$Wine=$_GET['Wine'];
			        $Winery=$_GET['Winery'];
          			$Grape=$_GET['Grape'];
			        $Region=$_GET['Region'];
          			$MinY=$_GET['YearR1'];
          			$MaxY=$_GET['YearR2'];
          			$MinC=$_GET['PriceR1'];
          			$MaxC=$_GET['PriceR2'];
          			$Req=$_GET['Available'];
          			$Sld=$_GET['Ordered'];

   		 		header ('Location: http://54.252.202.27/assign1/partB/SearchWine.php?Wine='.$Wine.'&Winery='.$Winery.'&Grape='.$Grape.'&Region='.$Region.'&YearR1='.$MinY.'&YearR2='.$MaxY.'&PriceR1='.$MinC.'&PriceR2='.$MaxC.'&Available='.$Req.'&Ordered='.$Sld.'&Submit=SEARCH');
			}
		}	
	}
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
 <body>
	<center>
		<form id="form1" name="form1" method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
  			<p><label><font><br /> <br />  <br />  <br /> <b>WINE NAME:</b> </font>
    				<input type="text" name="Wine" placeholder=" full name or part of it "/>
			   </label>
                        </p>
                        <p><label> <font><b> WINERY NAME: </b></font>
			        <input type="text" name="Winery" placeholder="full name or part of it"/>
			   </label>
  			</p>
 			<p><label> <font><b> GRAPE VARIETY:</b><font>
   				<select name="Grape">
    					<?php
					        while($row=mysql_fetch_array($GrapeVariety))
					        echo"<option value='$row[variety]'>$row[variety]</option>\n";
     					?>
				</select>
			   </label>
                        </p>
 			<p><label> <font><b> REGION:</b><font>
                                <select name="Region">
    					<?php
					        while($row=mysql_fetch_array($RegionQuery))
					        echo"<option value='$row[region_name]'>$row[region_name]</option>\n";
  					?>
				</select>
				</label>
			</p>
  			<p><label><font><b>YEAR RANGE </b></font>
     				<label><font><b> MIN:</b></font></label>
    					<select name="YearR1">
					<?php
 						while($row=mysql_fetch_array($YearQuery1))
					        echo"<option value='$row[year]' >$row[year]</option>\n";
  					?>
     					</select>
     				</label>
	 			<label><font><b> MAX:</b></font></label>
     					 <select name="YearR2">
					<?php
					         while($row=mysql_fetch_array($YearQuery2))
					         echo"<option value='$row[year]'>$row[year]</option>\n";
 					?>
   					</select>
   				</label>
                        </p>
  			<p><label><font><b>PRICE RANGE </b></font>
			        <label><font><b> MIN:</b></font></label>
    					<select name="PriceR1">
 					<?php
						 while($pricerow=mysql_fetch_array($PriceQuery1))
        					 echo"<option value='$pricerow[PRICE]'>$pricerow[PRICE]</option>\n";
					?>
    					</select>
				</label>
     			<label><font><b>MAX:</b></font></label>
    	                                <select name="PriceR2">
     					<?php
					     	while($pricerow=mysql_fetch_array($PriceQuery2))
					        echo"<option value='$pricerow[PRICE]'>$pricerow[PRICE]</option>\n";
					?>
    					</select>
		        </label>
  			</p>
  			<p><label><font><b>NO. OF WINES REQUIRED:</b></font>
				    <input type="text" name="Available" value="0" />
			    </label>
			</p>
  			<p><label><font><b>NO. OF WINES ORDERED:</b></font>
    				    <input type="text" name="Ordered" value="0" />
    		           </label>
  			</p>
  			<p>
    				<input type="submit" name="Submit" value="SEARCH" />
   			</p>
	</center>
 </body>
</html>
