<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/client-list/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $servername="localhost";
            $username="root";
            $password="";
            $database="myshop";
            $connection = new mysqli($servername, $username, $password, $database);

            //check connection

            if($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            //read all rows from database
            $sql = "SELECT * FROM clients";
            $result = $connection->query($sql);

            if(!$result) {
                die("Invalid query:". $connection->error);
            }

            //read data from each row
            while($row = $result->fetch_assoc()){
                echo"
                <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/client-list/edit.php?id=$row[id]'>
                        Edit
                    </a>
                    <a class='btn btn-danger tbn-sm' href='/client-list/delete.php?id=$row[id]'>Delete</a>
                </td>
            </tr>
            
            ";
            }
            ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>