<?PHP

	//database config file
	require '../configure.php';

	//variables for readability
	$server = DB_SERVER;
	$database = "addressbook";

	//get inputs from test1.php with ajax
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];

	try {
	    $conn = new PDO("mysql:host=$server;dbname=$database", DB_USER, DB_PASS);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo "Connected successfully"; 

	    //add values from form to database
	    $stmt = $conn->prepare("INSERT INTO tbl_address_book(First_Name, Last_Name, Email) VALUES (:firstname, :lastname, :email)");
	    $stmt->bindParam(":firstname", $firstname);
	    $stmt->bindParam(":lastname", $lastname);
	    $stmt->bindParam(":email", $email);
	    $stmt->execute();
	    echo "New record created successfully";
  }
	catch(PDOException $e) {
    	echo $conn . "<br>" . $e->getMessage();
  }

  // Close statement
  unset($stmt);
   
  // Close connection
  unset($conn);

?>