<?php
$pg="addmanufacturer";
require_once './header.php';
?>
<div class="starter-template">
    <h1>Add Manufacturer</h1>
    <div class="col-sm-6">
        <form id="frmaddmanufacturer">

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Manufacturer Name" name="manufacturername">
            </div>
            <button type="submit" name="savemanufacturer" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>
<?php require_once './footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#frmaddmanufacturer').validate({
            ignore: ".ignore",
            rules: {
                manufacturername: {
                    required: true,
                    remote: {
                        url: "checkmanufacturer.php",
                        type: "post"
                    }
                }
            },
            messages: {
                manufacturername:
                        {
                            required: "Please enter Manufacturer name",
                            remote: "Manufacturer already exist"
                        },
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
    });
</script>
