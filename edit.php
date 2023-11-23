<?php
$servername= "localhost";
$username = "root";
$password ="";  
$database="crud";
//Create connection
$connection = new mysqli($servername, $username, $password, $database);




$code = "";
$nom = "";
$description = "";
$budget = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET methode: Show the data of the projet

    if ( !isset($_GET["id"])){
        header("location: /crud/index.php");
        exit;
    }
    $id = $_GET["id"];

     
    // read the row of the selected projet from database table

    $sql = " SELECT * FROM projet WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        header("locaction: /crud/index");
        exit;
    }
    $code =$_POST["code"];
    $nom =$_POST["nom"];
    $description =$_POST["description"];
    $budget =$_POST["budget"];
}
else{
    //POST method : update or insert a new record in database
    $id =$_POST["id"];
    $code =$_POST["code"];
    $nom =$_POST["nom"];
    $description =$_POST["description"];
    $budget =$_POST["budget"];

    do{
        if (empty($code) || empty($nom) || empty($description) || empty($budget)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE projet" .
        "SET code ='$code' , nom='$nom', description='$description' , budget = '$budget'". 
        "WHERE id = $id";


        $result = $connection->query($sql);

        if (!$result){
            $errorMessage ="Invalid query:" . $connection->error;
            break;
        }

        $successMessage="Projet updated correctly";

        header("location: crud/index.php");
        exit;


    } while (true);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New projet</h2>

         <?php
         if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
         }
         ?>

        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Code</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="code" value="<?php echo $code; ?>">

                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">

                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">

                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Budget</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="budget" value="<?php echo $budget; ?>">

                </div>

            </div>

        <?php
           if (!empty($successMessage)){
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6>
                   <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>

            </div>
            ";
          }
        ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>


                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="crud/index.php" role="button">Cancel</a>

                </div>

            </div>

        </form>

    </div>
</body>
</html>
