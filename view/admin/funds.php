<?php

session_start();


require_once "../../model/admin/FundModel.php";


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


$funds = getAllFunds();


?>



<h1>
Manage Funds
</h1>



<input 
type="text"
id="search"
placeholder="Search fund..."
onkeyup="searchTable()">



<br><br>




<table border="1" cellpadding="10">


<tr>

<th>ID</th>

<th>Organization</th>

<th>Amount</th>

<th>Purpose</th>

<th>Request Date</th>

<th>Status</th>

<th>Action</th>


</tr>



<tbody id="fundTable">



<?php while($row=mysqli_fetch_assoc($funds)){ ?>


<tr>


<td>

<?= $row["id"] ?>

</td>



<td>

<?= $row["organization"] ?>

</td>



<td>

<?= $row["amount"] ?>

</td>



<td>

<?= $row["purpose"] ?>

</td>



<td>

<?= $row["request_date"] ?>

</td>



<td>

<?= $row["status"] ?>

</td>




<td>



<a 
href="../../controller/admin/FundController.php?delete=<?= $row["id"] ?>"
onclick="return confirm('Delete this fund request?')">


<button>

Delete

</button>


</a>




<?php if($row["status"]=="Pending"){ ?>


<br><br>



<a href="../../controller/admin/FundController.php?id=<?= $row["id"] ?>&status=Approved">


<button>

Approve

</button>


</a>





<a href="../../controller/admin/FundController.php?id=<?= $row["id"] ?>&status=Rejected">


<button>

Reject

</button>


</a>



<?php } ?>



</td>


</tr>



<?php } ?>



</tbody>


</table>







<script>


function searchTable()

{

let input =
document.getElementById("search")
.value
.toLowerCase();



let rows =
document
.getElementById("fundTable")
.getElementsByTagName("tr");



for(let i=0;i<rows.length;i++)

{

let text =
rows[i].innerText.toLowerCase();



if(text.includes(input))

{

rows[i].style.display="";

}

else

{

rows[i].style.display="none";

}

}


}



</script>