<!DOCTYPE html><?php 
?>
<html>
<head>
    <meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="draft.css">
    <title>Close Loan Acc</title>
</head>
<body>
   
    <div class="nav">
     <img src="pics/logo.jpg" width="100" height="100">
     <div class="links">
    <ul><li><A HREF="MainMenu.html">Home</A></li>
<li><A HREF="withdrawals.html">Withdrawals</A></li>
<li><A HREF="Lodgements.html">Lodgements</A></li>
<li><A HREF="CustomerMaintenance.html">Customer Maintenance</A></li>
<li><A HREF="AccountMaintenance.html">Account Maintenance</A></li>
<li><A HREF="Management.html">Management</A></li>
<li><A HREF="Reports.html">Reports</A></li>
<li><A HREF="Quotes.html">Quotes</A></li>
<li><A HREF="ChangePassword.html">Change Password</A></li>
</ul></div>
    </div>
   

        
        <script>
            function populate()
            {
                var sel= document.getElementById("listbox");
                var result;
                result = sel.options[sel.selectedIndex].value;
                var personDetails = result.split(',');
                document.getElementById("delid").value = personDetails[0];
				document.getElementById("delloanid").value = personDetails[1];
                document.getElementById("delfirstname").value = personDetails[2];
                document.getElementById("dellastname").value = personDetails[3];
                document.getElementById("delDOB").value = personDetails[4];
				document.getElementById("dellamount").value = personDetails[5];
            }
			function confirmCheck()
                {
                    var response;
                    response = confirm('Are you sure you want to close this account?');
                    if (response)
                    {
                     document.getElementById("delid").disabled = false;
					document.getElementById("delloanid").disabled = false;
                	document.getElementById("delfirstname").disabled = false;
                	document.getElementById("dellastname").disabled = false;
                	document.getElementById("delDOB").disabled = false;
						document.getElementById("dellamount").disabled = false;
                        return true;
                    }
                  else{
                    populate();
                    
                    return false;
                  }
                }
		</script><div class= 'loanbody'> <h1>Close a loan account</h1>
        <h4>Please select an account and then click the close button if you wish to close them </h4>
	<?php 
		include 'listboxloan.php'; 
        ?>

    <form name="myForm" action="closeloanacc.php" onsubmit="return confirmCheck()" method="post">
    <label for = 'delid'>Person Id </label>
    <input type="text" name = "delid" id = "delid" disabled><br><br>
		<label for = 'delid'>Loan Acc Id </label>
    <input type="text" name = "delloanid" id = "delloanid" disabled><br><br>
    <label for ='delfirstname'>First Name </label>
    <input type="text" name= "delfirstname" id= "delfirstname" disabled><br><br>
    <label for ='dellastname'>Surname</label>
    <input type="text" name= "dellastname" id = "dellastname" disabled><br><br>
		<div class= 'loanDOB'>
    <label for ='delDOB'>Date of Birth </label>
		<input type="date" name="delDOB" id="delDOB" title = "format is dd-mm-yyyy" disabled><br><br></div>
		    <label for ='dellamount'>Amount Owed</label>
    <input type="text" name= "dellamount" id = "dellamount" disabled>
     <br><br>
		<input type="submit" value="Close Account" > </form></div>
	
		</body>
		</html>