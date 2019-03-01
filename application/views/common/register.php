<div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url(<?php echo base_url('assets/img/login.jpg') ?>)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="POST" action="<?php echo base_url('Registration') ?>">
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
                      <i class="fa fa-address-card-o"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="firstname" placeholder="First Name...">
                </div>
                <span><?php echo form_error('firstname'); ?></span>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-address-card-o"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="lastname" placeholder="Last Name...">
                </div>
                <span><?php echo form_error('lastname'); ?></span>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock text_caps-small" ></i>
                      <!-- <i class="now-ui-icons text_caps-small"></i> -->
                    </span>
                  </div>
                  <input type="password" placeholder="Password..." name="password" class="form-control" />
                </div>
                <span><?php echo form_error('password'); ?></span>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock text_caps-small" ></i>
                      <!-- <i class="now-ui-icons text_caps-small"></i> -->
                    </span>
                  </div>
                  <input type="password" placeholder="Confirm Password..." name="confirm_password" class="form-control" />
                </div>
                <span><?php echo form_error('confirm_password'); ?></span>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-envelope"></i>
                    </span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="E-mail...">
                </div>
                <span><?php echo form_error('email'); ?></span>
              </div>
              <div class="card-footer text-center">
                <input type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block" value="Get Register">
                <div class="pull-left">
                  <h6>
                    <a href="<?php echo base_url('Login') ?>"  class="link" style="color:#ffffff">Sign In</a>
                  </h6>
                </div>
                <div class="pull-right">
                  <h6>
                    <a href="#" class="link" style="color:#ffffff">Need Help?</a>
                  </h6>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>