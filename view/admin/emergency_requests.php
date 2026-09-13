<?php

session_start();


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



require_once "../../model/admin/EmergencyRequestModel.php";


$requests = getAllEmergencyRequests();


?>



<h1>
Manage Emergency Requests
</h1>




<input 
type="text"
id="search"
placeholder="Search request..."
onkeyup="searchTable()">



<br><br>




<table border="1" cellpadding="10">


<tr>

<th>
ID
</th>


<th>
Citizen
</th>


<th>
Service
</th>


<th>
Emergency Type
</th>


<th>
People
</th>


<th>
Vehicles
</th>


<th>
Location
</th>


<th>
Status
</th>


<th>
Action
</th>


</tr>



<tbody id="requestTable">



<?php while($row = mysqli_fetch_assoc($requests)){ ?>


<tr>


<td>
<?= $row["request_id"] ?>
</td>



<td>
<?= $row["citizen_name"] ?>
</td>



<td>
<?= $row["service_type"] ?>
</td>



<td>
<?= $row["emergency_type"] ?>
</td>



<td>
<?= $row["people_count"] ?>
</td>



<td>
<?= $row["vehicles_requested"] ?>
</td>



<td>
<?= $row["location"] ?>
</td>




<td>
<?= $row["status"] ?>
</td>




<td>


<a href="../../controller/admin/EmergencyRequestController.php?id=<?= $row["request_id"] ?>&status=Accepted">

<button>
Accept
</button>

</a>



<a href="../../controller/admin/EmergencyRequestController.php?id=<?= $row["request_id"] ?>&status=On The Way">

<button>
On The Way
</button>

</a>




<a href="../../controller/admin/EmergencyRequestController.php?id=<?= $row["request_id"] ?>&status=Complete">

<button>
Complete
</button>

</a>





<a 
href="../../controller/admin/EmergencyRequestController.php?delete=<?= $row["request_id"] ?>"
onclick="return confirm('Delete this request?')">


<button>
Delete
</button>


</a>



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
.getElementById("requestTable")
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