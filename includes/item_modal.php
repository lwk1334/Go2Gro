<!DOCTYPE html>
<html>

<style>
    /*for add item modal */
    .bg-modal-add {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;
    }

    .modal-content-add {
        width: 1000px;
        height: 500px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }



</style>

<body>
    <!-- add item -->

    <div class="bg-modal-add">

        <div class="modal-content-add">
            <form class="form-horizontal" method="POST" action="items_add.php" id="addform" enctype="multipart/form-data">

                <?php

                $con = mysqli_connect("localhost", "admin", null, "go2gro");

                ?>

                <div class="form-group">
                    <br>
                    <label for="iname" class="col-sm-1 control-label">Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="iname" name="iname" required>
                    </div>


                </div>

                <div class="form-group">
                    <label for="istock" class="col-sm-1 control-label">Stock</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="istock" name="istock" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="iprice" class="col-sm-1 control-label">Price</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="iprice" name="iprice" required>
                    </div>

                    <label for="photo" class="col-sm-1 control-label">Photo</label>

                    <div class="col-sm-5">
                        <input type="file" id="photo" name="photo">
                    </div>
                </div>

                <div class="form-group">
                    <label for="idesc" class="col-sm-1 control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea name="idesc" rows="10" cols="130" required></textarea>
                    </div>

                </div>
                </form>
                <div class="modal-footer">
                    <a href="items.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                    <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
                </div>
            
        </div>
    </div>



</body>

</html>