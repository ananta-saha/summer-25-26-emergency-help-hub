<?php

session_start();


require_once "../../model/admin/NotificationModel.php";



if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}



$notifications = getAllNotifications();



?>



<h1>
Manage Notifications
</h1>




<a href="add_notification.php">

<button>
Add Notification
</button>

</a>



<br><br>




<input
type="text"
id="search"
placeholder="Search notification..."
onkeyup="searchTable()">



<br><br>




<table border="1" cellpadding="10">



<tr>

<th>ID</th>

<th>Receiver</th>

<th>Subject</th>

<th>Message</th>

<th>Date</th>

<th>Action</th>


</tr>





<tbody id="notificationTable">



<?php while($row=mysqli_fetch_assoc($notifications)){ ?>



<tr>


<td>

<?= $row["id"] ?>

</td>



<td>

<?= $row["receiver"] ?>

</td>




<td>

<?= $row["subject"] ?>

</td>




<td>

<?= $row["message"] ?>

</td>




<td>

<?= $row["created_at"] ?>

</td>





<td>


<a 
href="../../controller/admin/NotificationController.php?delete=<?= $row["id"] ?>"
onclick="return confirm('Delete this notification?')">


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
.getElementById("notificationTable")
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