<?php

session_start();


if(!isset($_SESSION["admin_id"]))
{
    header("Location: ../auth/login.php");
    exit();
}


?>


<h1>
Add Notification
</h1>



<form action="../../controller/admin/NotificationController.php" method="POST">



<label>
Receiver
</label>

<br>

<select name="receiver" required>

<option value="All">
All
</option>

<option value="Citizen">
Citizen
</option>


<option value="Provider">
Provider
</option>


<option value="Organization">
Organization
</option>


</select>



<br><br>




<label>
Subject
</label>

<br>

<input 
type="text"
name="subject"
required>



<br><br>




<label>
Message
</label>

<br>


<textarea 
name="message"
rows="5"
cols="40"
required></textarea>




<br><br>



<button type="submit" name="add">

Send Notification

</button>



</form>