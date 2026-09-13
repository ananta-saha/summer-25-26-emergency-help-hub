<?php

session_start();

require_once "../../model/admin/OrganizationManagementModel.php";


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


$organizations = getAllOrganizations();


?>


<h1>
Manage Organizations
</h1>


<a href="add_organization.php">

<button>
Add Organization
</button>

</a>


<br><br>


<!-- Search -->

<input 
type="text"
id="search"
placeholder="Search organization..."
onkeyup="searchTable()">


<br><br>



<table border="1" cellpadding="10">


<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Address</th>

<th>Type</th>

<th>Status</th>

<th>Action</th>


</tr>



<tbody id="orgTable">



<?php while($row=mysqli_fetch_assoc($organizations)){ ?>


<tr>


<td>

<?= $row["id"] ?>

</td>



<td>

<?= $row["name"] ?>

</td>



<td>

<?= $row["email"] ?>

</td>



<td>

<?= $row["phone"] ?>

</td>



<td>

<?= $row["address"] ?>

</td>



<td>

<?= $row["type"] ?>

</td>



<td>

<?= $row["status"] ?>

</td>




<td>


<a href="edit_organization.php?id=<?= $row["id"] ?>">

<button>
Edit
</button>

</a>




<a 
href="../../controller/admin/OrganizationController.php?delete=<?= $row["id"] ?>"
onclick="return confirm('Delete this organization?')">

<button>

Delete

</button>

</a>




<?php if($row["status"]=="Pending"){ ?>


<br><br>



<a href="../../controller/admin/OrganizationController.php?id=<?= $row["id"] ?>&status=Approved">


<button>

Approve

</button>


</a>




<a href="../../controller/admin/OrganizationController.php?id=<?= $row["id"] ?>&status=Rejected">


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
.getElementById("orgTable")
.getElementsByTagName("tr");



for(let i=0;i<rows.length;i++)

{


let text =
rows[i]
.innerText
.toLowerCase();



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