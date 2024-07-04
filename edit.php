
<?php
include 'data.php';
   $id = $_GET['upid'];
    $sql = "SELECT * FROM notes WHERE `id`=$id";
    $result = mysqli_query($conn, $sql);
    mysqli_num_rows($result);
    $note = mysqli_fetch_assoc($result);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
        $id=mysqli_real_escape_string($conn, $_POST['note_id']);
        $F = mysqli_real_escape_string($conn, $_POST['Fname']);
        $S = mysqli_real_escape_string($conn,$_POST['Sname']);
        $P = mysqli_real_escape_string($conn, $_POST['Phone']);
        $G = mysqli_real_escape_string($conn,$_POST['Gender']);
        $pic = $_FILES['img']['name'];
        if(empty($F) || empty($S) || empty($P) || empty($G) ){
            $msg = "Plz Fill all Fields";}
        else{            
            if(!empty($pic)){
                $arr = array('png','jpeg','jpg');
                $exe = strtolower(pathinfo($pic, PATHINFO_EXTENSION));   
                if(in_array($exe, $arr)) {
                    $pic = rand(10000,90000). "." .$exe;
                    unlink("uploads/". $note['Image']);
                    $sql = "UPDATE `notes` SET `Fname`='$F', `Sname`='$S', `Phone`='$P', `Address`='$G', `Image`='$pic' WHERE `ID`='$id'";
                    $run = mysqli_query($conn,$sql);    
                    if($run){
                        move_uploaded_file($_FILES['img']['tmp_name'],"uploads/".$pic);
                        $msg = "DATA HAS BEEN UPDATED";
                        header("Location:mynotes.php");
                        exit();
                    }else{
                        $msg = "DATA HAS NOT BEEN UPDATED";
                        header("Location:mynotes.php");
                        exit();
                    }    
                    }else{
                        $msg = "IMG IS NOT RIGHT";
                        header("Location:mynotes.php");
                        exit();
                    }
                }else{
                    $pic = $note['Image'];
                    $sql = "UPDATE `notes` SET `Fname`='$F', `Sname`='$S', `Phone`='$P', `Address`='$G', `Image`='$pic' WHERE `ID`='$id'";
                    $run = mysqli_query($conn,$sql);
        
                    if($run){                    
                     $msg = "DATA HAS BEEN UPDATED";
                            header("Location:mynotes.php");
                            exit();
                    }else{
                            $msg = "DATA HAS NOT BEEN UPDATED";
                            header("Location:mynotes.php");
                            exit();    
                    }
                    }                  
                }      
    }   
    ?>
<!doctype html>
<html lang="en">
<head>
 
  <style>
   * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            position: relative;
        }

            body::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('pics/3139767.jpg') center/cover no-repeat fixed;
                z-index: -1;
            }

        .container {
            min-height: 200vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            margin-top: 80px;
            width: 330px;
        }
         .main {
            height: 600px;
            font-family: 'Lato', sans-serif;
            position: relative;
            padding: 20px;
           
        }
         .input_text {
            margin-top: 20px;
            position: relative;
        
            height: 45px;
            width: 100%;
            border-radius: 30px;
            padding: 5px 20px;
            font-size: 14px;
            background-color: #fafafa;
            border: 0;
            outline: 0;
        }
         .button {
            margin-top: 20px;
            margin-left: 90px;
            display: flex;
            justify-content: center;
            align-items:center;
            position: relative;
        
                height: 45px;
                width: 100px;
                border: none;
                background-color:black;
                border-radius: 30px;
                color: #fff;
                font-size: 18px;
                cursor: pointer;
                transition: all 0.5s;
            }
            .gen{
                width:100px;
            }
  </style>
</head>
<body>
   
    <div class="container">
    <div class="card">
    <div class="card-body">
    <div class="main">
     <form method="POST"  enctype="multipart/form-data">
      First Name: <input class="input_text" type="text" name="Fname" value=" <?php echo $note['Fname'] ?> "><br>
      <br>Second Name: <input class="input_text" name="Sname" value=" <?php echo $note['Sname'] ?> "><br>
      <br>Phone: <input class="input_text" name="Phone" value=" <?php echo $note['Phone'] ?> "><br>
      <br>Gender: <select name="Gender" class="form-select input_text" id="Gender" required>
     <option value=" <?php echo $note['Address'] ?>"> <?php echo $note['Address'] ?></option>
     <option value="Male">Male</option>
     <option value="Female">Female</option>
     <option value="Other">Other</option>
      </select><br>
      <br>Image: <input class="input_text" type="file" name="img"><br>
      <input type="hidden" class="input_text" name="note_id" value=" <?php echo $id ?> ">
      <button class="button" type="submit" name="save_changes" value="Update">Update </button>
      </form>
      </div>
      </div>
      </div>
      </div>


</body>
</html>