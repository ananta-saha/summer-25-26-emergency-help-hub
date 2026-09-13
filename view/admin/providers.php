<?php

session_start();


require_once "../../model/admin/ProviderManagementModel.php";


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



$providers = getAllProviders();


?>



<h1>
Manage Service Providers
</h1>



<a href="add_provider.php">

<button>
Add Provider
</button>

</a>



<br><br>



<input 
type="text"
id="search"
placeholder="Search provider..."
onkeyup="searchTable()">



<br><br>




<table border="1" cellpadding="10">


<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Service Type</th>

<th>Location</th>

<th>Status</th>

<th>Action</th>


</tr>



<tbody id="providerTable">



<?php while($row=mysqli_fetch_assoc($providers)){ ?>


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

<?= $row["service_type"] ?>

</td>



<td>

<?= $row["location"] ?>

</td>



<td>

<?= $row["status"] ?>

</td>




<td>



<a href="edit_provider.php?id=<?= $row["id"] ?>">

<button>

Edit

</button>

</a>





<a 
href="../../controller/admin/ProviderController.php?delete=<?= $row["id"] ?>"
onclick="return confirm('Delete this provider?')">


<button>

Delete

</button>


</a>





<?php if($row["status"]=="Pending"){ ?>


<br><br>



<a href="../../controller/admin/ProviderController.php?id=<?= $row["id"] ?>&status=Approved">


<button>

Approve

</button>


</a>





<a href="../../controller/admin/ProviderController.php?id=<?= $row["id"] ?>&status=Rejected">


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
.getElementById("providerTable")
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