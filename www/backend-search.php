<?php

    //database config file
    require '../configure.php';

    //variables for readability
    $server = DB_SERVER;
    $database = "addressbook";

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database", DB_USER, DB_PASS);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    try {
        if(isset($_REQUEST['term'])){
            //execute search
            $sql = "SELECT * FROM tbl_address_book WHERE Email LIKE :term";
            $stmt = $conn->prepare($sql);
            $term = $_REQUEST['term'] . '%';  //get input from search box
            $stmt->bindParam(':term', $term);
            $stmt->execute();

            //output matching contacts
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch()){
                    echo "<p>" . $row['First_Name'] . "<br>" . $row['Last_Name'] . "<br>" . $row['Email'] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        }
    } catch (PDOException $e) {
        die("ERROR: Not able to execute $sql. " . $e->getMessage());
    }

    // Close statement
    unset($stmt);
     
    // Close connection
    unset($pdo);

?>