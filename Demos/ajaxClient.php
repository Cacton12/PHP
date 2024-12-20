<script type="text/javascript" src="../Includes/jquery-1.4.1.min.js">
	$(document).ready(function() {
		// initialization code…
	});
	$(() => {
		$(':input').each(function() {
			if (this.type != "submit") {
				this.value = "";
			}
		});
		$("#comment_submitted").hide();

	});
	function frmComment_submit( ) {
	$("#submit_a_comment").hide( );
	$("#comment_submitted").slideDown("slow");
	return false;
}
</script>
<?php
// This code prevents page caching

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 	// Date in the past
header("Pragma: no-cache");
?>

<?php
// Database Connectivity

$db_connected = mysqli_connect("localhost", "root", "", "ajaxDemo")
	or die("Not connected : " . mysql_error());
$db_name = "ajaxDemo";
//$db_selected = mysql_select_db($db_name, $db_connected)
//	or die("Not selected : " . mysql_error());
?>


<html>

<head>
	<title>Ajax Demo</title>

	<!-- Required stylesheet 																-->
	<link rel="stylesheet" type="text/css" href="../Includes/ajaxDemo.css" />

	<!-- jQuery is a JavaScript library, used to extend, enhance, and simplify JavaScript. 	-->
	<!-- jQuery is accessed by simply including a JavaScript file. -->

	<script type="text/javascript" src="../Includes/jquery-3.3.1.min.js"></script>

	<script type="text/javascript">
		// STEP.1 -- This function is called when the page loads	
		// jQuery being used -  						

		// Clear the form - http://api.jquery.com/ready
		$(document).ready(function() {
			// Clear the form (FF caches form data between refreshes by default)
			// Activate the following code if you want all the form fields to be cleared on load.
			// Be aware that any values you have initially set in radio buttons will be cleared by this code,
			// so if you want to use it, you'll have to trap the user selected radio button and assign a value manually!

			// $(':input').each(	 function( ) {
			//					 	if (this.type != "submit") {
			//			   			   this.value="";
			//						}
			// 					 }
			//				  );

			// Initially hide the "Comment Submitted" message or http://api.jquery.com/hide 
			$('#comment_submitted').hide();

		});
		// End of jQuery STEP.1
	</script>




	<script type="text/javascript">
		// STEP.4 -- This JavaScript function will be called when you submit your comment via the form	

		function frmComment_submit() {

			// The $.get function is one utilization of JQuery's ajax capability
			// Ref http://api.jquery.com/jQuery.get 
			$.get(

				// (STEP.4)Parameter 1: the url of the remote script
				// ajaxServer.php is the code that will insert our data into the appropriate table				
				// It receives data from this page, executes at the server, and returns control to this page.	
				// STEP.5 -- See the code in this file...														
				"ajaxServer.php",

				// (STEP.4) Parameter 2: data sent to the server
				// The form where you entered your data is called "frmComment"		
				$("#frmComment").serializeArray(),

				// (STEP.4) Parameter 3: the callback function
				// ie What do you want to do with the data returned from ajaxServer.php?	
				function(data) {

					// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
					// If you're having problems with your ajaxServer page, 															
					// activate the following alert line *and* change parameter 4 below to "html".										
					//alert(data);	
					// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE	

					// Build a comment element to be added to the page	
					var commentDiv = '<div class="user_comment">' +
						'<p><span class="user_comment_name">' +
						'You commented:' +
						'</span></p>' +
						'<p class="user_comment_text">' + data.comment + '</p>' +
						'<p><br/ ><br /><img src="../Images/stars_rating_03.gif" height=19 width=91 align=right></p>' +
						'</div>';

					// Prepend ("put before") the comment to the appropriate element
					// So, you're instructing the page to display the <div> you built above 			
					// just before the <div> called "previously_submitted_comments" (see HTML below).	
					$("#previously_submitted_comments").prepend(commentDiv);

					// Comment was submitted, so hide "the first" message
					$("#thefirst").hide();

				},

				// (STEP.4) Parameter 4:  Type of Data 
				"json"
				// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
				// If you're having problems with your ajaxServer page, 															
				// change the above to "html" and activate the alert(data) found at parameter 3 above.								
				// DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE DEBUG CODE 	
			);

			// Comment was submitted, so hide the comment form or http://api.jquery.com/hide 
			$("#submit_a_comment").hide();

			// Show the "thank you" (STEP.8) message using a slideDown animation - http://api.jquery.com/slidedown
			$("#comment_submitted").slideDown("slow");

			return false;
		}
		// End of STEP.4
	</script>

</head>

<body>

	<div id="wrapper">
		<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! -->

		<h3>Comments:</h3>

		<!-- STEP.2 -- Get previous comments (if any) from the database -->
		<div id="previously_submitted_comments">
			<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! -->
			<?php

			$strSQL = "SELECT name, comment FROM comments ORDER BY id DESC";
			$rsComments = mysqli_query($db_connected, $strSQL)
				or die($db_name . " : " . $strSQL . " : " . mysql_error());

			if (mysqli_num_rows($rsComments) == 0) {
				echo '
					 <div class="user_comment" id="thefirst">
					 	    <p>Customer reviews are submitted by consumers like you everyday! 
								  These perspectives are a series of views of the product in different settings 
								  that may help you in your purchasing decisions. 
								  We do not filter reviews based on positive or negative content.</p>
					 </div>
				';
			} else while ($rowComments = mysqli_fetch_array($rsComments)) {
				echo '
					 <div class="user_comment">
					 	  <p>Submitted By: <span class="user_comment_name">' . $rowComments['name'] . '</span></p>
						  <p class="user_comment_text">' . $rowComments['comment'] . '</p>
						  <p><br /><br /><img src="../Images/stars_rating_00.gif" height=19 width=91 align=right></p>
					 </div>
				';
			}

			mysqli_close($db_connected);
			?>
		</div>

		<!-- STEP.3 -- Enter new comment -->
		<div id="submit_a_comment">
			<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! -->
			<h3>Submit a Comment:</h3>
			<form id="frmComment" name="frmComment" onsubmit="return frmComment_submit();">
				<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! -->
				<label for="name">Name:</label><br />
				<input type="text" id="name" name="name" value="" size="52" /><br />
				<label for="comment">Comment:</label><br />
				<textarea id="comment" name="comment" cols="40" rows="10"></textarea><br />
				<input type="submit" value="Submit" name="submit" />
			</form>
		</div>

		<!-- STEP.8 -- Confirm receipt of comment -->
		<p id="comment_submitted">Thank you for your comment.</p>
		<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! -->
	</div>

</body>

</html>