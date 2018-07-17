<?php
$pg="addmodel";
session_start();
require_once './header.php';
require_once './function.php';
$newobj = new carfunction();
$_SESSION['savemodelimage'] = "";
$getmanufacturer = $newobj->getManufacturer(null, 1);
$datetimestr = "_" . date("His");
$_SESSION['savemodelimage'] = rand(10, 100) . $datetimestr;
?>
<div class="starter-template">
    <h1>Add Model</h1>
    <div class="col-sm-6">
        <form id="frmaddmodel" >
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Model Name" name="modelname">
            </div>
            <div class="form-group col-sm-6">
                <select class="form-control" name="manufacturer">
                    <option selected disabled>Select Manufacturer Name</option>
                    <?php while ($row = mysqli_fetch_array($getmanufacturer)) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Price" name="price">
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Fuel Type" name="fueltype">
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Mileage" name="mileage">
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Engine" name="engine">
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Transmission" name="transmission">
            </div>
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" placeholder="Kerb Weight" name="weight">
            </div>
            <div class="col-sm-12 pd0 form-group">
                <div class="col-sm-12 mb10"><label class="control-label">Upload Images</label> </div>
                <div class="col-sm-12">
                    <div class="dropzone" id="listingimage"> 

                    </div>
                </div> 
            </div>
            <div class="form-group col-sm-6">
                <button type="submit" name="savemodel" class=" btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
<?php
require_once './footer.php';
?>
<script>
    Dropzone.autoDiscover = false;
    $("#listingimage").dropzone({
        url: "uploadimage.php",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        dictDuplicateFile: "Duplicate Files Cannot Be Uploaded",
        preventDuplicates: false,
        dictDefaultMessage: "Click here to Upload Listing Images Or Drag here to Upload",
        init: function () {
            var thisDropzone = this;
            thisDropzone.on('removedfile', function (file) {

                var imagename = file.name;
                var jsonData = {"deleteimagebyuser": 1, "imagename": imagename, "deleteimageusingdropzone": 1, "beforesavepropimgdelet": 1};
                $.ajax({
                    type: "POST",
                    url: "<?= DASHBOARD_URL ?>userattributes.php",
                    data: jsonData,
                    success: function (data) {

                    }
                });
            });
        },
        success: function (file, response) {
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }


    });
    $(document).ready(function () {
        $('#frmaddmodel').validate({
            ignore: ".ignore",
            rules: {
                price: "required",
                manufacturer: "required",
                modelname: "required",
            },
            messages: {
                price: " Please Enter Price",
                manufacturer: " Please select manufacturer",
                modelname: " Please select manufacturer",
            },
            submitHandler: function (form)
            {

                var data = new FormData(form);
                // var data = $("#frmcontact").serialize();

                $.ajax({
                    url: "attribute.php",
                    type: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var result = $.trim(data);
                        if (result == 1) {
                            swal({
                                title: "Done!",
                                text: "Successfully added Manufacturer",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#337ab7",
                                confirmButtonText: "Ok",
                                closeOnConfirm: true

                            },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            location.reload();
                                        }
                                    });
                        } else {
                            swal("Sorry", "Something went wrong.Please tray again!", "error");
                        }
                    }
                });
            }

        });
    })
</script>
