<!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="<?php echo base_url() ?>" rel="tooltip" data-placement="bottom">
          Meal Man
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="<?php echo base_url('assets/img/blurred-image-1.jpg') ?>">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Sign In" data-placement="bottom" href="<?php echo base_url('Login') ?>">
              <i class="fa fa-sign-in" style="font-size:24px"></i>
              <p class="d-lg-none d-xl-none">Login</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Sign Up" data-placement="bottom" href="<?php echo base_url('Register') ?>">
              <i class="fas fa-user-plus" style="font-size:22px"></i>
              <p class="d-lg-none d-xl-none">Registration</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->