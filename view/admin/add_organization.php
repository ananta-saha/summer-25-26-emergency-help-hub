<h2>Add Organization</h2>


<form method="POST"
action="../../controller/admin/OrganizationController.php">


<input 
type="text"
name="name"
placeholder="Organization Name"
required>

<br><br>


<input 
type="email"
name="email"
placeholder="Email"
required>


<br><br>


<input 
type="text"
name="phone"
placeholder="Phone">


<br><br>


<input 
type="text"
name="address"
placeholder="Address">


<br><br>


<input 
type="text"
name="type"
placeholder="Type (NGO/Hospital)">


<br><br>


<button name="add_organization">

Add Organization

</button>


</form>