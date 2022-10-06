<!DOCTYPE html>
<html>

<?php
include 'includes/session.php';
include 'header.php';
include 'sidebar.php';

$con = mysqli_connect("localhost", "admin", null, "go2gro");
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Members
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Members</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="#" class="btn btn-primary btn-sm btn-flat" id="addmembers" ><i class="fa fa-plus"></i> New</a>
                <div class="box-body">
                  <table class="table table-bordered">
                    <thead>
                      <th>Member ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Address</th>
                      <th>Tools</th>
                    </thead>
                    <tbody>
                      <?php

                      $query = "SELECT * FROM members";
                      $result = mysqli_query($con, $query);

                      

                      if (mysqli_num_rows($result) == 0) {
                        echo "<p>No Member Record Found.</p>";
                      } else {
                        while ($row = mysqli_fetch_array($result)) {
                                                      echo "
                            <tr>
                            <td style='width:120px'>" . $row['member_id'] . "</td>
                            <td style='width:150px'>" . $row['first_name'] . "</td>
                            <td style='width:150px'>" . $row['last_name'] . "</td>
                            <td style='width:150px'>" . $row['email'] . "</td>
                            <td style='width:150px'>" . $row['mobile_number'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td style='width:150px'>
                            <a href ='members_edit.php?id=".$row['member_id']."'><button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['member_id'] . "'><i class='fa fa-edit'></i> Edit</button></a>
                              <button onclick='deleteMember(".$row['member_id'].")' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['member_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                           </tr>
                            ";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>



      </section>
    </div>
  </div>

<?php
include 'includes/members_modal.php';
?>

<script>

document.getElementById('addmembers').addEventListener('click',
function(){
  document.querySelector('.bg-modal-addmember').style.display = 'flex';

});

function deleteMember(memberID){
  var result = confirm("Are you sure you would like to DELETE this member?");
  if(result){
    window.location = "members_delete.php?id="+memberID;
  }
}



</script>





</body>

</html>