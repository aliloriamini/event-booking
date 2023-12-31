<?php
define('BaseDir', $_SERVER["DOCUMENT_ROOT"] .'/eventBookingSystem');
require_once (BaseDir . '/controller/eventController.php');

// total price for sum participation fee

$total_price = 0;

// post method set data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of search bar

    $employee_name = $_POST['employee_name'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];

    $results = getEventData($employee_name,$event_name,$event_date);
}else{

    $employee_name = '';
    $event_name = '';
    $event_date = '';
    $results = getEventData();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>event book - report event</title>
<!--    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
<!--    <link href="css/datepicker.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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

    <div class="row ">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div style="font-size: 20px;font-weight: bold;margin-bottom: 2px"> filters: </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="row ">
                            <div class="col">
                                <label for="employee_name">Employee name:</label>
                                    <input type="text" name="employee_name" id="employee_name" class="form-control" placeholder="employee name"
                                           value="<?= $employee_name ?>">
                            </div>
                            <div class="col">
                                <label for="event_name">Event name:</label>
                                <input type="text" name="event_name" id="event_name" class="form-control" placeholder="event name"
                                       value="<?= $event_name ?>">
                            </div>
                            <div class="col">
                                <label for="datepicker">Event date:</label>
                                <input type="text" name="event_date" class="form-control" placeholder="event date"
                                       id="datepicker"
                                       value="<?= $event_date ?>">
                            </div>
                            <div class="col">
                                <button class="btn btn-success" style="margin-top: 22px" name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">participation id</th>
                    <th scope="col">employee name</th>
                    <th scope="col">employee mail</th>
                    <th scope="col">event id</th>
                    <th scope="col">event name</th>
                    <th scope="col">participation fee</th>
                    <th scope="col">event date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $result) : ?>
                    <tr>
                        <td><?= $result['id'] ?></td>
                        <td><?= $result['participation_id'] ?></td>
                        <td><?= $result['employee_name'] ?></td>
                        <td><?= $result['employee_mail'] ?></td>
                        <td><?= $result['event_id'] ?></td>
                        <td><?= $result['event_name'] ?></td>
                        <td><?= $result['event_date'] ?></td>
                        <td><?= $result['participation_fee'] ?></td>
                        <?php
                         $total_price = $total_price + $result['participation_fee'];
                        ?>
                    </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr class="table-success">
                    <td>Sum Fee</td>
                    <td colspan="6"></td>
                    <td>$<?= number_format($total_price) ?></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<!--<script src="javascript/jquery-3.3.1.min.js"></script>-->
<!--<script src="javascript/datepicker.min.js" type="text/javascript"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>


<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5'
    });
</script>
<!--<script src="javascript/bootstrap.bundle.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
