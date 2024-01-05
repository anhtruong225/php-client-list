<?php
$servername="localhost";
$username="root";
$password="";
$database="myshop";
$connection = new mysqli($servername, $username, $password, $database);

$id="";
$name ="";
$email ="";
$phone ="";
$address ="";
$errorMessage ="";
$successMessage="";



if( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show data of client: check if ID of client is exist or not, if not exists, head to the list in index.php
if(!isset($_GET['id'])) {
    header("location:/client-list/index.php");
    exit;
}

//if exist, update the client
$id = $_GET["id"];

//Step1: Connect to db (at beginning of this file)
//step2: select the client which has the chosen id and fetch the equivalent data, $row shows the data row of the id 

$sql="SELECT * FROM clients WHERE id=$id";
$result= $connection->query($sql);
$row=$result->fetch_assoc();

//step3: if it is different from $row ->head back to index.php
if(!$row) {
    header("location:/client-list/index.php");
    exit;
}
$name = $row["name"];
$email =$row["email"];
$phone =$row["phone"];
$address =$row["address"];

}
else {
//POST_method: update data
$id = $_POST["id"];
$name = $_POST["name"];
$email =$_POST["email"];
$phone =$_POST["phone"];
$address =$_POST["address"];

do{
    if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address) ) {
        $errorMessage = "All the fields are required";
        break;
    }

    $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
    $result = $connection->query($sql);

    if(!$result){
        $errorMessage = "Invalid query: " . $connection->error;
        break;
    }
    $successMessage = "Client's information is successfully updated";

    header("location: /client-list/index.php");
    exit;
}
while(false);
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
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
           </div>

           "; 
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php
            if(!empty($successMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role= 'alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
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