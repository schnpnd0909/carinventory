<?php
session_start();
require_once './function.php';
$newobj = new carfunction();
$my_date = date("Y-m-d H:i:s");
if (isset($_POST['manufacturername']) && isset($_POST['savemanufacturer'])) {

    $manufacturername = mysqli_real_escape_string($newobj->con, trim($_POST['manufacturername']));
    $data = array(
        'manufacturername' => $manufacturername,
        'status' => 1,
        'modifiedat' => $my_date
    );
    $addmanufacturer = $newobj->insertManufacturer($data);
    if ($addmanufacturer) {
        echo "1";
    }
}
if (isset($_POST['modelname']) && isset($_POST['savemodel'])) {
    $modelname = mysqli_real_escape_string($newobj->con, trim($_POST['modelname']));
    $manufacturer = mysqli_real_escape_string($newobj->con, trim($_POST['manufacturer']));
    $price = mysqli_real_escape_string($newobj->con, trim($_POST['price']));
    $fueltype = mysqli_real_escape_string($newobj->con, trim($_POST['fueltype']));
    $mileage = mysqli_real_escape_string($newobj->con, trim($_POST['mileage']));
    $engine = mysqli_real_escape_string($newobj->con, trim($_POST['engine']));
    $transmission = mysqli_real_escape_string($newobj->con, trim($_POST['transmission']));
    $weight = mysqli_real_escape_string($newobj->con, trim($_POST['weight']));

    $data = array(
        'name' => $modelname,
        'manufacturerid' => $manufacturer,
        'price' => $price,
        'fueltype' => $fueltype,
        'mileage' => $mileage,
        'engine' => $engine,
        'transmission' => $transmission,
        'weight' => $weight,
        'modifiedat' => $my_date,
    );

    $savemodel = $newobj->insertModel($data);
    if ($savemodel) {
        $updateimage = $newobj->updateModelimage($savemodel, $my_date, $_SESSION['savemodelimage']);
        if ($updateimage) {
            echo "1";
        }
    }
}

if (isset($_POST['getmodeldetails']) && isset($_POST['modelid'])) {
    $modelid = mysqli_real_escape_string($newobj->con, trim($_POST['modelid']));
    $getcars = $newobj->getCars($modelid);
    $rowcar = mysqli_fetch_array($getcars);
    $getimagescount = $newobj->getImages($modelid);
    $getimages = $newobj->getImages($modelid);
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $rowcar['modelname'] ?></h4>
    </div>
    <div class="modal-body">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">

                <?php
                $count = 0;
                while ($rowimagesct = mysqli_fetch_array($getimagescount)) {
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?= $count ?>" class="<?php if ($count == 0) {
                echo "active";
            } ?>"></li>
        <?php
        $count++;
    }
    ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
    <?php
    $countimg = 0;
    while ($rowimages = mysqli_fetch_array($getimages)) {
        ?>
                    <div class="item <?php if ($countimg == 0) {
                echo "active";
            } ?>">
                        <img src="<?= $rowimages['image_path'] ?>" alt="<?= $rowimages['name'] ?>" >
                    </div>
        <?php
        $countimg++;
    }
    ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </div>
    <div class="modal-body">
        <h4>
            <div class="col-sm-6">
              <p>  Price : <?= $rowcar['price'] ?></p>
            </div>
            <div class="col-sm-6">
                <p>Fuel Type : <?= $rowcar['fueltype'] ?></p>
            </div>
            <div class="col-sm-6">
                <p>Mileage : <?= $rowcar['mileage'] ?></p>
            </div>
            <div class="col-sm-6">
                <p>Engine : <?= $rowcar['engine'] ?></p>
            </div>
            <div class="col-sm-6">
                <p>Transmission : <?= $rowcar['transmission'] ?></p>
            </div>
            <div class="col-sm-6">
                <p>Weight : <?= $rowcar['weight'] ?></p>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-danger salemodel" id="<?= $rowcar['id'] ?>"  >Sale</a>
            </div>
        </h4>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    <?php
}

if (isset($_POST['salemodel']) && isset($_POST['modelid'])) {
        $modelid = mysqli_real_escape_string($newobj->con, trim($_POST['modelid']));
        echo $salemodel=$newobj->saleModel($modelid);
        
}

