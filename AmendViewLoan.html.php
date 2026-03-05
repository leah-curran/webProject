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
<h2>Amend/View a loan Account</h2>
<?php 
include 'listbox.php'; 
?>
<script>
    function populate()
            {
                var sel= document.getElementById("listbox");
                var result;
                result = sel.options[sel.selectedIndex].value;
                var personDetails = result.split(',');
                document.getElementById("display").innerHTML = "The details of the selected person are: " + result;
                
            }
   function toggleLock()
                {
                    if (document.getElementById("amendViewbutton").value= "Amend Details")
                {
                        document.getElementById("amendloanamount").disabled = false;
                        
                    
                        document.getElementById("amendViewbutton").value= "Amend Details"
                }
                else
                {
                         document.getElementById("amendloanamount").disabled = true;
                        
                    
                        document.getElementById("amendViewbutton").value= "Amend Details"
                }
                }    
function confirmCheck()
                {
                    var response;
                    response = confirm('Are you sure you want to save these changes?');
                    if (response)
                    {
                        document.getElementById("amendid").disabled = false;
                        document.getElementById("amendloanamount").disabled = false;
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
                
    <p id="display"> </p>

    <input type="button" value="Amend Details" id = "amendViewbutton" onclick="toggleLock()">
    <form name="myForm" action="AmendViewLoan.php" onsubmit="return confirmCheck()" method="post">
    <label for = 'amendid'>Person Id </label>
    <input type="text" name = "amendid" id = "amendid" disabled>
    <label for ='amendloanamount'>Loan Amount </label>
    <input type="text" name= "amendloanamount" id= "amendloanamount" disabled>
    
    
    <input type="submit" value="Save Changes" > </form>
    </div>
</body></html>