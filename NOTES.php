<?php
include 'data.php';
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $sname = mysqli_real_escape_string($conn,$_POST['Sname']);
    $phone = mysqli_real_escape_string($conn,$_POST['Phone']);
    $gender = mysqli_real_escape_string($conn,$_POST['Gender']);
    $image = $_FILES['imageFile']['name'];
    if(empty($fname) || empty($sname) || empty($phone) || empty($gender) ){
        $msg = "Plz Fill all Fields";}
    else{ 
   $new= [];
   foreach($image as $key => $im){
   $arr = array('png', 'jpeg', 'jpg');
   $exe = strtolower(pathinfo($im, PATHINFO_EXTENSION));
   if(in_array($exe, $arr)){
   $pic= rand(100,500).".".$exe;
   if (move_uploaded_file($_FILES['imageFile']['tmp_name'][$key], "uploads/" . $pic)) {
    $new[] = $pic;
}
   }
}
   $imageSerial = serialize($new);
   $sql= "INSERT INTO `notes`(`Fname`,`Sname`,`Address`,`Phone`, `Image`) VALUES ('$fname','$sname', '$gender','$phone','$imageSerial')";
   $result= mysqli_query($conn, $sql);
  if($result){
     $message= "Data inserted Sucessfully";

    }
    else{
        $message= "Error inserting Data";
    }
}
}


?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Form</title>
    <style>
        .form-control {
            width: 400px;
        }
        .uploadicon {
            position: relative;
            top: 1em;
        }
        .btn {
            padding: 0.5em 2em;
        }
        .row1{
            display: flex;
            justify-content: space-around;
        }
        #Gender{
            width: 400px
        }
        .file{
            margin-left:5em;
            margin-top:3em;

        }
        .uploadiv{
            width:800px;
            height:200px;
            background-color:rgb(236, 236, 236);
            border-radius: 10px;
            border: 5px dotted grey;
            text-align: center;
            margin-left: 3em;
            
        }
        .head{
            margin-top:1em;
            margin-bottom:1em
        }
       #submit{
        margin-left:5em
       }
       .navbar{
        margin-top:-25px;
       }
        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark " >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
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
    if(isset($message)){
    ?>  
<div class="alert alert-secondary" role="alert">
<?php
    echo @$message;
  
}
    ?>
    </div>
    <div class="container" >
        <h2 class="head">Add Information</h2>
        <form  method="POST" enctype="multipart/form-data">
            <div class="row1">
            <div class="mb-3">
                <label for="Fname" class="form-label">First Name</label>
                <input type="text" name="Fname" class="form-control" id="Fname" required>
            </div>
            <div class="mb-3">
                <label for="Sname" class="form-label">Second Name</label>
                <input type="text" name="Sname" class="form-control" id="Sname" required>
            </div>
    </div>
    <div class="row1">
            <div class="mb-3">
                <label for="Gender" class="form-label">Gender</label>
                <select name="Gender" class="form-select" id="Gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Phone Number</label>
                <input type="text" name="Phone" class="form-control" id="Phone" required>
            </div></div>
            <div class="mb-4 file ">
                
                <label for="imageFile" class="form-label"><div class="uploadiv">
                    <img src="asset/img/upload.png" width="120" height="120" style="margin-top:2em">
                </div></label>
                <input style="display: none;" type="file" class="form-control" id="imageFile" name="imageFile[]" accept=".jpg,.jpeg,.png,.gif" multiple required>
                
            </div>
            <div class="mb-3">
                <button type="submit" name="add" id="submit"class="btn btn-dark">Submit</button>
            </div>
        </form>
    </div>
    

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

   