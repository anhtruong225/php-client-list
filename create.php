<?php
$servername="localhost";
$username="root";
$password="";
$database="myshop";
$connection = new mysqli($servername, $username, $password, $database);

$name ="";
$email ="";
$phone ="";
$address ="";
$errorMessage ="";
$successMessage="";


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
$name = $_POST["name"];
$email =$_POST["email"];
$phone =$_POST["phone"];
$address =$_POST["address"];

do{
if(empty($name) || empty($email) || empty($phone) || empty($address) ) {
    $errorMessage = "All the fields are required";
    break;
}

//insert new client to database

$sql = "INSERT INTO clients (name, email, phone, address) " . 
"VALUES ('$name', '$email', '$phone', '$address')";
$result = $connection->query($sql);

if (!$result) {
    $errorMessage = "Invalid query: " . $connection->error;
    break;
}

$name ="";
$email ="";
$phone ="";
$address ="";

$successMessage = "Client is newly added";
header("location: /client-list/index.php");
exit;

}while(false);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if(!empty($errorMessage)) {
           echo "
           <div class='alert alert-warning alert-dismissible fade show' role= 'alert'>
           <strong>$errorMessage</strong>
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-lable='Close'></button>
           </div>

           "; 
        }
        ?>
        <form method="post">
            <div class="row md-3">
                <lable class="col-sm-3 col-form-label">Name</lable>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row md-3">
                <lable class="col-sm-3 col-form-label">Email</lable>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row md-3">
                <lable class="col-sm-3 col-form-label">Phone Number</lable>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row md-3">
                <lable class="col-sm-3 col-form-label">Address</lable>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php
            if(!empty($successMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role= 'alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-lable='Close'></button>
                </div>
     
                ";
            }
            ?>
            <div class="row md-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/client-list/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>