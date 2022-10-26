<aside class="main-sidebar">
<a href="dashboard.php"><img style="margin-left: 20px; padding-bottom: 40px;" src=images/go2gro.png></a>
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">


  <?php

  if($_SESSION['role'] == 'Manager'){

    ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="employees.php"><i class="fa fa-users"></i> <span>Employees</span></a></li>
      <li><a href="members.php"><i class="fa fa-users"></i> <span>Members</span></a></li>
      <li><a href="sales.php"><i class="fa fa-shopping-cart"></i> <span>Sales</span></a></li>
      <li><a href="items.php"><i class="fa fa-file-o"></i> <span>Item List</span></a></li>
      <li><a href="stocklow.php"><i class="fa fa-shopping-basket"></i> <span>Items Low in Stock</span></a></li>

      <li class="header">OTHERS</li>
      <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
      
    </ul>

    <?php
  }

  ?>

  <?php

  if($_SESSION['role'] == 'Employee'){

    ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="members.php"><i class="fa fa-users"></i> <span>Members</span></a></li>
      <li><a href="sales.php"><i class="fa fa-shopping-cart"></i> <span>Sales</span></a></li>
      <li><a href="items.php"><i class="fa fa-file-o"></i> <span>Item List</span></a></li>

      <li class="header">OTHERS</li>
      <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
      
    </ul>

    <?php
  }

  ?>
  </section>
  <!-- /.sidebar -->
</aside>
