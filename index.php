<?php
$pg="index";
require_once './header.php';
session_start();
require_once './function.php';
$newobj = new carfunction();
$getcars = $newobj->getCars();
?>

<div class="starter-template">
    <h1>Cars</h1>
    <div class="row">
        <?php
        $getcount= mysqli_num_rows($getcars);
        if($getcount > 0){
        ?>
        <?php while ($row = mysqli_fetch_array($getcars)) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <?php
                    $getimages = $newobj->getImages($row['modelid']);
                    $rowimg = mysqli_fetch_array($getimages);
                    ?>
                    <img src="<?= $rowimg['image_path'] ?>" alt="<?= $rowimg['name'] ?>">
                    <div class="caption">
                        <h3><?= $row['modelname'] ?></h3>
                        <p>
                            Price: <?= $row['price'] ?><br/>
                            Fuel Type: <?= $row['fueltype'] ?><br/>
                            Mileage: <?= $row['mileage'] ?><br/>
                            Engine <?= $row['engine'] ?><br/>
                        </p>
                        <p><a data-toggle="modal" data-target="#myModal" id="<?= $row['modelid'] ?>" class="btn btn-primary viewmodel" role="button">View</a> </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php }else{
         echo "<h1>No more Model Found.</h1>";
        }
        ?>
    </div>   

</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modelbind">

        </div>

    </div>
</div>
<?php require_once './footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.viewmodel').click(function () {
            var modelid = $(this).attr('id');
            var jsonData = {"getmodeldetails": 1, "modelid": modelid, };
            $.ajax({
                type: "POST",
                url: "attribute.php",
                data: jsonData,
                success: function (data)
                {
                    //alert(data);
                    //$("#select_subcategory").removeAttr("disabled");
                    $('.modelbind').html($.trim(data));
                },
                complete: function () {
                }
            });
        });
    })
    $(document).on('click', '.salemodel', function () {
        var modelid = $(this).attr('id');
        swal({
            title: "Are you sure?",
            text: "You want to sale this model",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-Primary",
            confirmButtonText: "Yes, Sale it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        var jsonData = {"salemodel": 1, "modelid": modelid, };
                        $.ajax({
                            type: "POST",
                            url: "attribute.php",
                            data: jsonData,
                            success: function (data)
                            {
                                var result = $.trim(data);
                                if (result == '1') {
                                    location.reload();
                                } else if (result == '2') {
                                    location.reload();
                                }
                            },
                            complete: function () {
                            }
                        });

                    } else {
                        swal("Cancelled", "Model is not for sale :)", "error");
                    }
                });
    });
</script>