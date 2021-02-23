<!-- 
Week 7 Assignment
Katelyn Blalock 
12/5/2020
-->

<!--This is the HTML to create a form that will grab the customer's ID-->
<!DOCTYPE html>
<html>
<head>
	<title>Send a Customer's Bill</title>
</head>
<body style="text-align:center;">
<form method="post" action="sendBill.php">
		<h1>Send a Customer Bill</h1>
		<p>Customer ID:
		<input type="text" name="customerID" size="10" /></p>
		<input type="submit" name="submit" /></p>
	</div>
</form>
</body>

<?php
//the connectDB.php file establishes the connection to the landscape database
include ('connectDB.php');

//if the user has clicked Submit, check to see if the Customer ID submitted is in the customers table
if(isset($_POST['customerID']))
{
$sqlStatement = "SELECT * FROM customers";
$customers = mysqli_query($dbConn, $sqlStatement);
$customerexists = false;
while ($row = mysqli_fetch_array($customers))
{ 
	//if the Customer ID submitted is in the customers table, send the user to the sendBill page
	if($row['customer_ID'] == $_POST['customerID'])
		{
		$customer = $_POST['customerID'];
		header("location: ../week7_kblalock/emailSent.php?customerID=" . $customer);
		}
}

//if the Customer ID submitted is not in the customers table, alert the user
echo "Customer ID not found.";	
}
?>