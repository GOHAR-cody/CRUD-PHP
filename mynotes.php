
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Notes</title>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">INotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="NOTES.php">Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="mynotes.php">View</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
   <?php
   include 'data.php';
   ?>
    <div class="container" style="padding-top:1em ;" >
        <h2 style="margin-bottom:1em">Registered Users</h2>
    <?php
$query = "SELECT * FROM `notes`";
$res = mysqli_query($conn, $query);

if ($res) {
    ?>
     <table   id="mytable" class="table">
       <thead >
         <tr style="margin-top:1em">
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Second Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
     </thead>
     <tbody>
        <?php
    $i=1;
    while ($ar = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $ar['Fname'] ?></td>
                <td><?php echo $ar['Sname'] ?></td>
                <td><?php echo $ar['Phone'] ?></td>
                <td><?php echo $ar['Address'] ?></td>
                <td><img src="uploads/<?php echo $ar['Image'] ?>" alt="<?php echo $ar['Image'] ?>" width="100" height="50"></td>
                <td>
                <a class="btn btn-danger" href="delete.php?upid=<?php echo $ar['id'] ?>">Delete</a>
                <a class="btn btn-success" href="edit.php?upid=<?php echo $ar['id'] ?>">Update</a>
                </td>
        </tr>
       
        <?php
         $i=$i+1;
    }
    ?>
    </tbody>
    </table>
  <?php
} else {
    // Handle query execution failure, display an error message, or log the error.
    echo 'Error executing the query: ' . mysqli_error($conn);
}

?>




   
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>

let table = new DataTable('#mytable');</script>




</body>
</html>