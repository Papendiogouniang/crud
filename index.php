<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
     <div class="container my-5">
          <h2>liste des projets</h2>
          <a href="btn btn-primary" href="/niangshop/create.php" role="button">New projet</a>
          <br>
          <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Budget</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $servername= "localhost";
                $username = "root";
                $password ="";  
                $database="crud";
                //Create connection
                $connection = new mysqli($servername, $username, $password, $database);
                //Check connection
                if ($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error);
                }
                //read all row from database table
                $sql = "SELECT * FROM projet";
                $result = $connection->query($sql);
                if (!$result){
                    die ("Invalid query:" . $connection->error);
                }
                //Read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[id]</td>
                    <td>$row[code]</td>
                    <td>$row[nom]</td>
                    <td>$row[description]</td>
                    <td>$row[budget]</td>
                    <td>$row[date]</td>
                    <td>$row[statut]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/crud/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm'href='/crud/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                    ";

                }
                ?>
                
            </tbody>
          </table>
     </div>
</body>
</html>
