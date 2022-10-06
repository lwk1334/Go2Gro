<!DOCTYPE html>
<html>

<style>
    /*for add prod modal */
    .bg-modal-addmember {
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

    .modal-content-addmember {
        width: 1000px;
        height: 400px;
        background-color: white;
        border-radius: 4px;
        /* text-align: center; */
        padding: 20px;
        position: relative;
    }
</style>

<body>
    <!-- add member -->

    <div class="bg-modal-addmember">

        <div class="modal-content-addmember">
            <form class="form-horizontal" method="POST" action="members_add.php" id="addform" enctype="multipart/form-data">

                <div class="form-group">
                    <br>
                    <label for="fname" class="col-sm-1 control-label">First Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>

                    <label for="lname" class="col-sm-1 control-label">Last Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                </div>

                <div class="form-group">

                    <label for="email" class="col-sm-1 control-label">Email</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>

                    <label for="mobileno" class="col-sm-1 control-label">Mobile No</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="mobileno" name="mobileno" required>
                    </div>
                </div>

                <div class="form-group">
                
                <label for="address" class="col-sm-1 control-label">Address</label>
                    <div class="col-sm-5">
                        <textarea name="address" rows="7" cols="115" required></textarea>
                    </div>
                    
                </div>
            </form>
            <div class="modal-footer">
                <a href="members.php"><button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button></a>
                <button type="submit" form="addform" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Add</button>
            </div>

        </div>
    </div>



</body>

</html>