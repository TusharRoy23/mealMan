<div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url(<?php echo base_url('assets/img/login.jpg') ?>)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="POST" action="<?php echo base_url('LoggedIn') ?>">
              <div class="card-header text-center">
                <div class="logo-container">
                  <!-- <img src="<?php //echo base_url('assets/img/now-logo.png') ?>" alt=""> -->
                  <i class="fa fa-user-circle-o" style="font-size:80px"></i>
                </div>
              </div>
              <div class="card-body">
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" name="username" class="form-control" placeholder="Username...">
                </div>
                <span><?php echo form_error('username'); ?></span>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock text_caps-small" ></i>
                      <!-- <i class="now-ui-icons text_caps-small"></i> -->
                    </span>
                  </div>
                  <input type="password" name="password" placeholder="Password..." class="form-control" />
                </div>
                <span><?php echo form_error('password'); ?></span>
              </div>
              <div class="card-footer text-center">
                <input type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block" value="Get Started">
                <div class="pull-left">
                  <h6>
                    <a href="<?php echo base_url('Register') ?>"  class="link" style="color:#ffffff">Create Account</a>
                  </h6>
                </div>
                <div class="pull-right">
                  <h6>
                    <a href="#pablo" class="link" style="color:#ffffff">Need Help?</a>
                  </h6>
                </div>
              </div>
            </form>
            <?php 
                if($this->session->flashdata('message')){
              ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 10%">
                    <div class="alert-icon">
                      <i class="now-ui-icons ui-2_like"></i>
                    </div>
                     <b><?php  echo $this->session->flashdata('message'); ?></b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                      </span>
                    </button>
                    
                  </div>
              <?php
                  $this->session->unset_userdata('message');
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>