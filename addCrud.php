<?php
$db = require("db.php");
$config = require('config.php');
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if (isset($_POST["submit"])) {
    $email = $_POST["floating_email"];
    $firstname = $_POST["floating_first_name"];
    $lastname = $_POST["floating_last_name"];
    $work = $_POST["floating_work"];

    $query = "INSERT INTO userDetails (firstname, lastname, work, email) VALUES ('$firstname', '$lastname', '$work', '$email')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Record inserted successfully";
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.tailwindcss.com"></script>

<!-- Add Tailwind CSS classes for styling -->
<div class="flex flex-col">
    <!-- Table for displaying records -->
    <table class="border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">Id</th>
                <th class="border border-gray-300 p-2">First Name</th>
                <th class="border border-gray-300 p-2">Last Name</th>
                <th class="border border-gray-300 p-2">Work</th>
                <th class="border border-gray-300 p-2">Email</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch records from database and display -->
            <?php
            // Fetch records from the database and loop through them
            $query = "SELECT * FROM userDetails";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='border border-gray-300 p-2'>" . $row['id'] . "</td>";
                echo "<td class='border border-gray-300 p-2'>" . $row['firstname'] . "</td>";
                echo "<td class='border border-gray-300 p-2'>" . $row['lastname'] . "</td>";
                echo "<td class='border border-gray-300 p-2'>" . $row['work'] . "</td>";
                echo "<td class='border border-gray-300 p-2'>" . $row['email'] . "</td>";
                echo "<td><button class='bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2'><a href='edit.php?id=" . $row['id'] . "'>Edit</a></button></td>";
                echo "<td><button class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded'><a href='delete.php?id=" .$row['id']."'>Delete</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>