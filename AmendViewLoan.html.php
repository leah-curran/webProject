<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="draft.css">
    <title>Amend/View Loan Account </title>
</head>

<script>
    function populate()
            {
                var sel= document.getElementById("listbox");
                var result;
                result = sel.options[sel.selectedIndex].value;
                var personDetails = result.split(',');
                document.getElementById("amendid").value = personDetails[0];
            }
   function toggleLock()
                {
                    if (document.getElementById("amendViewbutton").value= "Amend Details")
                {
                        document.getElementById("amendloanamount").disabled = false;
					    document.getElementById("amendloanperiod").disabled = false;
                        document.getElementById("amendid").disabled = false;
                    
                        document.getElementById("amendViewbutton").value= "Amend Details"
                }
                else
                {
                         document.getElementById("amendloanamount").disabled = true;
					     document.getElementById("amendloanperiod").disabled = true;
                        document.getElementById("amendid").disabled = true;
                    
                        document.getElementById("amendViewbutton").value= "Amend Details"
                }
                }    
function confirmCheck()
                {
                    var response;
                    response = confirm('Are you sure you want to save these changes?');
                    if (response)
					{
                        document.getElementById("amendloanamount").disabled = false;
						document.getElementById("amendloanperiod").disabled = false;
                        return true;
                    }
                }
                    </script>

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
    <div class="loanbody">
    <h2>Amend/View a loan Account</h2>
		<?php 
include 'listbox.php'; 
?><br><br>
    <input type="button" value="Amend Details" id = "amendViewbutton" onclick="toggleLock()"><br><br>
    <form name="myForm" action="AmendViewLoan.php" onsubmit="return confirmCheck()" method="post">
	<label for ='amendid'>PersonID</label>
    <input type="text" name= "amendid" id= "amendid" disabled> <br><br>
  			<label>Loan Payment Period</label>
          <input type="number" name="loanperiod" min="12" required />
          <br>
           <p><label > Enter Loan Amount</label>
             <input type ="number" step = ".01" name = "bal" id = "bal" placeholder="Balance" autocomplete= off required>
         <br>
           </p><br>
    
    
    <input type="submit" value="Save Changes" > </form>
    </div>
</body></html>