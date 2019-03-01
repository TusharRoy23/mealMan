		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header card-header-primary">
                  		<h4 class="card-title">Edit Profile</h4>
                  		<p class="card-category">Complete your profile</p>
                	</div>
                	<div class="card-body">
						<form enctype="multipart/form-data" id="profileUpdateSubmit">
						<?php
							if ($profile) {
								foreach ($profile as $key) {
						?>
									<div class="card-header card-header-default card-header-icon">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-12">
												<div class="form-group">
													<input type="text" name="firstname" value="<?php echo $key['firstName'] ?>" id="firstname" class="form-control" >
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-12">
												<div class="form-group">
													<input type="text" name="lastname" value="<?php echo $key['lastName'] ?>" id="lastname" class="form-control" >
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-12">
												<div class="form-group">
													<input type="email" name="email" value="<?php echo $key['email'] ?>" class="form-control" id="email">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-12">
												<!-- <div class="form-group form-file-upload form-file-simple">
												    <input type="text" class="form-control inputFileVisible" placeholder="Simple chooser...">
												    <input type="file" class="inputFileHidden">
  												</div> -->
											  	<!-- <div class="form-group form-file-upload form-file-multiple">
												    <input type="file" class="inputFileHidden">
												    <div class="input-group">
												        <input type="text" class="form-control inputFileVisible" placeholder="Single File">
												        <span class="input-group-btn">
												            <button type="button" class="btn btn-fab btn-round btn-primary">
												                <i class="material-icons">attach_file</i>
												            </button>
												        </span>
												    </div>
											  	</div> -->
											  	<!-- <div class="form-group form-file-upload form-file-multiple">
											    	<input type="file" multiple="" class="inputFileHidden">
											    	<div class="input-group">
												        <input type="text" class="form-control inputFileVisible" placeholder="Multiple Files" multiple>
												        <span class="input-group-btn">
												            <button type="button" class="btn btn-fab btn-round btn-info">
												                <i class="material-icons">layers</i>
												            </button>
												        </span>
											    	</div>
											  	</div> -->
											  	<!-- <div class="fileinput fileinput-new text-center" data-provides="fileinput">
											        <div class="fileinput-preview" style="width: 200px; height: 150px;">
											        	<?php 
											        		if($key['photo']):
											        	?>
											        	<?php 
											        		else:
											        	?>
											        			<img src="<?php echo base_url('assets/img/no-image3.jpg') ?>" alt="..." class="rounded-circle" height="100" width="100">
											        	<?php 
											        		endif;
											        	?>
											        </div>
											        <div>
											        <span class="btn btn-raised btn-round btn-rose btn-file">
											            <span class="fileinput-new">Add Photo</span>
											    	<span class="fileinput-exists">Change</span>
											    	<input type="file" multiple="" name="..." /></span>
											            <br />
											            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
											        </div>
    											</div> -->
    											<!-- <div class="fileinput fileinput-new" data-provides="fileinput">
												  <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
												  <div>
												    <span class="btn btn-outline-secondary btn-file">
												      <span class="fileinput-new">Select image</span>
												      <span class="fileinput-exists">Change</span>
												      <input type="file" name="...">
												    </span>
												    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
												  </div>
												</div> -->
												<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											       	<div class="fileinput-new thumbnail img-raised">
											    		<?php 
											        		if($key['photo']):
											        	?>
											        			<img src="<?php echo base_url('').'/'.$key['photo'] ?>" alt="..." height="210" width="200">
											        	<?php 
											        		else:
											        	?>
											        			<img src="<?php echo base_url('assets/img/no-image-face.png') ?>" alt="..." height="210" width="200">
											        	<?php 
											        		endif;
											        	?>
											       	</div>
											       	<div class="fileinput-preview fileinput-exists " style="max-width: 200px; max-height: 200px;"></div>
											       	<div>
												    	<span class="btn btn-raised btn-round btn-rose btn-file">
												    	   	<span class="fileinput-new">Select image</span>
												    	   	<span class="fileinput-exists">Change</span>
												    	   	<input type="file" name="imageFile" id="image_file" />
												    	</span>
											            <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
											            <i class="fa fa-times"></i> Remove</a>
											       	</div>
    											</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="form-group">
													<input type="submit" id="profileUpdateBtn" name="submit" class="btn btn-block btn-info btn-md" value="Update">
													<!-- <a style="cursor: pointer;" class="btn btn-block btn-info btn-md profileUpdateBtn">Update</a> -->
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="form-group">
													<a href="<?php echo base_url('Profile') ?>" class="btn btn-block btn-danger btn-md">Reset</a>
												</div>
											</div>
										</div>
										
									</div>
						<?php
								}
							}
						?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>