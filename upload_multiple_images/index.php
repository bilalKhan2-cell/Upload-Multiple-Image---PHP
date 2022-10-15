<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap.css">
</head>
<body>
    <div class="container p-3">
        <form method="POST" enctype="multipart/form-data">
        <label for="d">Select Images: </label>
        <input type="file" name="myimage[]" multiple id="ds" />
        <input type="submit" value="Submit" class="btn btn-primary" name="btn" />
        </form>
    </div>
</body>
</html>
<?php

if(isset($_REQUEST['btn']))
{
    $n = count($_FILES['myimage']['name']);

    $stringToSubmit = "";

    for($a=0;$a<$n;$a++)
    {
        $fileName = uniqid()."-".time();
        $extension = pathinfo($_FILES['myimage']['name'][$a],PATHINFO_EXTENSION);
        $basename = $fileName.".".$extension;

        $source = $_FILES['myimage']['tmp_name'][$a];
        $stringToSubmit.=$basename;
        $stringToSubmit.=",";

        move_uploaded_file($source,"images/".$basename."");
    } 

    $con = mysqli_connect("localhost","root","","tblImages");
    $submitQuery = mysqli_query($con,"insert into val(image) values('".$stringToSubmit."');");

    if($submitQuery)
    {
        echo "<div class='container-fluid text-center fixed-bottom alert alert-primary alert-dismissible fade show'><strong>Images Added Successfully...</strong></div>";
    }
  
}

?>