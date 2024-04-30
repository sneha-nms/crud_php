<?php
// Include necessary files and create database connection
$db = require("db.php");
$config = require('config.php'); 
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

$id = $_GET['id'];

if(isset($_POST['submit'])){
    $firstname = mysqli_real_escape_string($conn, $_POST['floating_first_name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['floating_last_name']);
    $work = mysqli_real_escape_string($conn, $_POST['floating_work']);
    $email = mysqli_real_escape_string($conn, $_POST['floating_email']);

    // Prepare the update query using prepared statement
    $query = "UPDATE `userDetails` SET `firstname`='$firstname', `lastname`='$lastname', `work`='$work', `email`='$email' WHERE id =$id";

    $result = mysqli_query($conn, $query);

    if($result){
        echo "Record updated successfully";
        header("Location:addCrud.php"); // Redirect after successful update
        exit(); // Terminate script after redirect
    } else {
        echo "Error: ".mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    

<?php 
// Include necessary files and create database connection

$id=$_GET['id'];

// Check if 'id' parameter is provided in the URL
if(isset($_GET['id'])) {

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // echo $id;
    
    // Fetch data from the database
    $query = "SELECT * FROM userDetails WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if($result) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle database query error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle missing 'id' parameter
    echo "Error: 'id' parameter is missing.";
}
?>

<form class="max-w-md mx-auto mt-5" method="post">
    <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="floating_email" value="<?php echo isset($row["email"]) ? $row["email"] : ''; ?>" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
    </div>
 
    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="floating_first_name" value="<?php echo isset($row["firstname"]) ? $row["firstname"] : ''; ?>" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="floating_last_name" value="<?php echo isset($row["lastname"]) ? $row["lastname"] : ''; ?>" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
        </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="floating_work" value="<?php echo isset($row["work"]) ? $row["work"] : ''; ?>" id="floating_work" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_work" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Work</label>
    </div>

    <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

</body>
</html>
