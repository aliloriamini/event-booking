<?php
define('BaseDir', $_SERVER["DOCUMENT_ROOT"] .'/eventBookingSystem');
require_once (BaseDir . '/controller/readJson.php');

// post method set data
$message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get file Json
    $target_path = $_SERVER["DOCUMENT_ROOT"].'/eventBookingSystem/data/'.basename( $_FILES['path']['name']);
    if(move_uploaded_file($_FILES['path']['tmp_name'], $target_path)) {
        insertMultiData($target_path);
        $message = "File uploaded successfully!";
    } else{
        $message = "Sorry, file not uploaded, please try again!";
    }
    //$result = insertMultiData($path);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>event book - insert Json Event</title>
<!--    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../assets/image/rexx_logo.svg">

</head>
<body>

<!-- nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="https://www.rexx-systems.com/">
        <img alt="rex logo" src="https://www.rexx-systems.com/wp-content/uploads/2021/01/rexx_logo_get_more.svg" width="100px">
    </a>


    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="https://www.linkedin.com/in/aliloriamini">About me</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_SERVER['PHP_SELF'] == '/eventBookingSystem/view/index.php')?'active':''?>" href="index.php">report Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_SERVER['PHP_SELF'] == '/eventBookingSystem/view/insertData.php')?'active':''?>" href="insertData.php">Insert Json Event</a>
            </li>
        </ul>
    </div>
</nav>

<!-- search bar-->
<br>
<br>
<br>


<div class="container-fluid">

    <?php if ($message != null) : ?>
        <div class="alert alert-primary" role="alert">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-10">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <div class="row ">
                    <div class="col">
                        <input type="file" name="path" class="form-control" placeholder="employee name">
                    </div>
                    <div class="col">
                        <button class="btn btn-success " name="submit" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            <br>

        </div>
        <div class="col-1"></div>
    </div>
</div>

<!--<script src="javascript/jquery-3.3.1.min.js"></script>-->
<!--<script src="javascript/bootstrap.bundle.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
