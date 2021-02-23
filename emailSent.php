<!DOCTYPE html>
<html>
<head>
	<title>Email Success</title>
</head>

<?php
//the connectDB.php file establishes the connection to the landscape database
include ('connectDB.php');

//store the customerID submitted into a variable
$customerID = $_GET['customerID'];	

//SQL statements and functions for gathering the customer's info from the billing table in order to find out the customer's customer_bill and amt_paid
$billingSqlStatement = "SELECT * FROM billing WHERE (customer_ID = '$customerID')";
$billingResult = mysqli_query($dbConn, $billingSqlStatement); 
$billingRecord = mysqli_fetch_array($billingResult);

//Store customer_bill and amt_paid into new variables, and subtract them in order to get amount left
$billamount = $billingRecord['customer_bill'];
$amountpaid = $billingRecord['amt_paid'];
$amountleft = $billamount - $amountpaid;

//Print the customer information onto the page
echo "<center><h1>Billing Information for Customer ID " . $customerID . ":</h1>";
echo "Bill amount: $". $billamount;
echo "<br> Amount paid: $". $amountpaid;
echo "<br> Amount remaining: $". $amountleft . "</center><br>";

//SQL statement for gathering the customer's info from the billing table in order to find out the customer's email
$emailSqlStatement = "SELECT * FROM customers WHERE (customer_ID = '$customerID')";
$emailResult = mysqli_query($dbConn, $emailSqlStatement);
$emailRecord = mysqli_fetch_array($emailResult);
$to = $emailRecord['customer_Email'];
$from = "katieblalock314@gmail.com";
$headers = "From:" . $from;

//if amountleft is greater than 0, send an email alerting the customer of how much they still owe
if ($amountleft > 0) 
	{
	$subject = "Reminder of Balance Due";
	$message = "Dear customer, \n \nThis is a reminder that you still owe $" . $amountleft . ". Please pay the remainder of your bill at your soonest convenience. \n \nThank you!";
	}

//if amountleft is 0 or less, make the contents of the email thank the customer
else 
	{
	$subject = "Thank you for your payment!";
	$message = "Dear customer, \n \nThank you for your payment! Lee looks forward to working with you again. \n \nHave a wonderful day!";
	}	
	
//send the email to the customer and let the user know an email was sent
mail($to, $subject, $message, $headers); 
echo "<center>An email has been sent to customer in regards to their current billing status.</center>";

//the closeDB.php file closes the connection to the landscape database
include ('closeDB.php');	
?>
<p><center><button onclick="document.location='sendBill.php'">Send New Email</button></center></p>	
</html>