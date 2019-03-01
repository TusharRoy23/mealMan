<div class="sidebar" data-color="purple" data-background-color="white" data-image="<?php echo base_url('assets/img/sidebar-1.jpg') ?>">
		<div class="logo">
        	<a href="http://www.creative-tim.com" class="simple-text logo-normal">
          		MealMan
        	</a>
      	</div>
        <?php $exp = explode("/", $_SERVER['REQUEST_URI']); ?>
      	<div class="sidebar-wrapper">
        	<ul class="nav">
          <li class="nav-item <?php if($exp[2] == 'Dashboard') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('Dashboard') ?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if($exp[2] == 'Friend-board') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('Friend-board') ?>">
              <i class="material-icons">person</i>
              <p>Friends</p>
            </a>
          </li>
          <li class="nav-item <?php if($exp[2] == 'Schedule-list') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('Schedule-list') ?>">
              <i class="material-icons">content_paste</i>
              <p>Schedule List</p>
            </a>
          </li>
          <li class="nav-item <?php if($exp[2] == 'Active-page') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('Active-page') ?>">
              <i class="material-icons">library_books</i>
              <p>Page</p>
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a class="nav-link" href="./icons.html">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./map.html">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./rtl.html">
              <i class="material-icons">language</i>
              <p>RTL Support</p>
            </a>
          </li>
          <li class="nav-item active-pro ">
            <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Upgrade to PRO</p>
            </a>
          </li> -->
        	</ul>
      	</div>
	</div>