<?php
// This code prevents page caching

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1			
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 	// Date in the past	
	header("Pragma: no-cache");
?> 

<?php
// Normally, we would place our database connectivity code here.				
// In the case of this 1-2-3 example, you will find it embedded in Step3 below.	

?>

<html>
 
<head>
	<title>Simple Scripting Demo</title>
</head>

<body>
<?php 
// "Database Connectivity"

	// Normally, because you only have to connect once per page,
	// you would put this at the top of the page.				

	
	// Server													
	$db_server = "localhost";
  
	// Database username (root is default)						
	$db_user = "root";
  
	// Database password 										
	// Our database doesn't have a password						
	$db_passwd = "";
  
	// Database name 											
	// In this example, should be the one you created in phase 1	
	$db_name = "ProductsDemo";
	
	// 1. Create a connection to the local database				
	$db_connected = mysqli_connect($db_server, $db_user, $db_passwd,$db_name) 
		or die("Not connected : " . mysql_error());

// End of "Database Connectivity"		
?>

<?php
// "Retrieve Desired Record Set"

	// If you only plan on executing one SQL statement, you would put this at the top of the page.  
	// If you plan on multiple SQL queries, depending on logic, you could embed in the page. 		
	// In the case of this simple example, I would put this at the top of the page.					

	// Build your SQL query string... MAKE SURE you select all the fields you need!	
	$strCategory = "Tools";
	$strSQL = "SELECT ID, Category, Image, Price, Description, Option1Desc, Option1a, Option1b, Option1c, Option1d, Option2Desc, Option2a, Option2b, Option2c, Option2d FROM Products ORDER BY Category";
	// Misspell one of the above fieldnames and see what error you get on your webpage.				
	
	// or  $strSQL = "SELECT * FROM Products WHERE Category = '$strCategory' ORDER BY ID";				
	// SELECT * is a bad lazy habit to get into.  If you have a large database with many fields,		
	// selecting all of them to save you typing impacts heavily on your server resources!				
	
		
	// For a better understanding of PHP string characteristics, see the StringsDemo.php page.
	
	// 3. Execute SQL to seed a "Products Record Set" variable										
	// As always, it is recommended to use relevent variable names.									
	$rsProd = mysqli_query($db_connected, $strSQL)
		or die($db_name . " : " . $strSQL . " : " . mysql_error());
		
// End Of "Retrieve Desired Record Set"
?>
<?php 
// "Display Individual Records"

  // 4. Since in our example our SQL has probably returned more than one record,									
  //    we need to loop through "Products Record Set" to grab each "product row" 									
  
  // 	"mysql_fetch_array(???)" is a function that reads a single record (row) from the provided ??? recordset.	
  
  while ($rowProd = mysqli_fetch_array($rsProd)) {
  
    //    Obviously, if you know your previous logic does not retrieve multiple records, you would not need to loop!	
	//	  Keep that in mind for future exercises.
   	   
	   //  Note how the database content is displayed				
	   //  Note the image filename... now pulled from the database, and injected into an HTML statement
	   
	   echo '
		  <hr /><br />
		  <img src="images/' 		. $rowProd["Image"] . '.gif" height=100 width=100 align=left />
		  Item #' 					. $rowProd["ID"] .  
		  '<br />Price :: ' 		. number_format($rowProd["Price"], 2, ".", ",") . 
		  '<br />Category :: ' 		. $rowProd["Category"] . 
		  '<br />Description::' . $rowProd["Description"] . '<br 
		  />
		';
		
		// You can't put logic inside an echo, so we closed it above.							
		// Now we can execute some further logic...
		
		// Display Option1... currently all hardcoded.		
		// Change to be dynamic, from database.
		if (true) {
			echo '
				<br clear=all /><br />'
				. $rowProd["Option1a"] .'<br />
				<ul>'
					. ($rowProd["Option1a"] != "" ? '<li>' . $rowProd["Option1a"] . '</li>': "") . ($rowProd["Option1b"] != "" ? '<li>' . $rowProd["Option1b"] . '</li>': "")
					 . ($rowProd["Option1c"] != "" ? '<li>' . $rowProd["Option1c"] . '</li>': "") . ($rowProd["Option1d"] != "" ? '<li>' . $rowProd["Option1d"] . '</li>' : "") .
				'</ul>
			';
		}
					
		// Display Option2... currently mostly hardcoded, but with some							
		// provided code for inspiration. Change to be dynamic, from database.					
		if ( $rowProd["Option2Desc"] != "" ) {
		   	echo '
				<br clear=all /><br /> '
				. $rowProd["Option2Desc"] . ' <br /> 
				<ul>'
					 . ($rowProd["Option2a"] != "" ? '<li>' . $rowProd["Option2a"] . '</li>': "") . ($rowProd["Option2b"] != "" ? '<li>' . $rowProd["Option2b"] . '</li>': "")
					 . ($rowProd["Option2c"] != "" ? '<li>' . $rowProd["Option2c"] . '</li>': "") . ($rowProd["Option2d"] != "" ? '<li>' . $rowProd["Option2d"] . '</li>' : "") .
				'</ul>
			';
		}	
} // End of the while		

// End of "Display Individual Records"	
?>
</BODY>
</HTML>

<!-- <li>' . $rowProd["Option2a"] . '</li> <li>' . $rowProd["Optionb"] . '</li>
<li>' . $rowProd["Option2c"] .'</li> <li>' . $rowProd["Option2d"] . '</li> -->