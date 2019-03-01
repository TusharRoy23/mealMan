		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card card-stats" style="background-color: #dff9fb">
					<div class="card-header card-header-default card-header-icon" style="text-align: center;">
						<h3 class="card-title" style="color: #e056fd; font-weight: bold;">
							Friends
						</h3>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div>
					<?php
						$i = 0;
						if ($mutual_friends) {
					?>
							<table>
								<tr>
					<?php
							foreach ($mutual_friends as $key)
							{
								if($key['mutualID'] != userStorageData()->profileId):
					?>
								<td width="550">
									<div style="margin-right: 8%; margin-left: 6%; margin-bottom: 8%">
										<div class="card card-stats">
											<div class="card-header card-header-default card-header-icon">
												<div class="col-sm-12 col-md-12" style="padding-left: 0px">
													<div class="card-icon">
								                  		<?php
								                  			if ($key['photo']) {
								                  		?>
								                  				<img src="<?php echo base_url('').'/'.$key['photo'] ?>" alt="..." width="110" height="120">
								                  		<?php
								                  			} 
								                  			else {
								                  		?>
								                  				<img src="<?php echo base_url('assets/img/no-image3.jpg') ?>" width="110" height="120">
								                  		<?php	
								                  			}	
								                  		?>
							                  		</div>
												</div>
												<div class="col-sm-12 col-md-12" style="padding-right: 0px">
													<h3 class="card-title">
										                <?php 
										                	echo $key['firstName'] .' '.$key['lastName'];
										                ?>
							                  		</h3>
												</div>
							                  	<div class="col-sm-12 col-md-12" style="padding-right: 0px">
							                  		<p class="card-category">
							                  			E-mail: <?php echo $key['email'] ?>
							                  		</p>
							                  	</div>
							                  	<div class="col-sm-12 col-md-12" style="padding-right: 0px">
							                  		<p class="card-category">
							                  			Joining Date: <?php echo $key['activationDate'] ?>
							                  		</p>
							                  	</div>
							                </div>
											<div class="card-footer">
												<a style="cursor: pointer; color: white;" class="btn btn-md btn-block btn-info" onclick="unfollowUser(<?php echo $key['mutualID'] ?>)">
													<span id="<?php echo 'followUnfollow-'.$key['mutualID'] ?>"><b>Unfollow</b></span>
												</a>
											</div>
										</div>
									</div>
								</td>
					<?php
								$i++;
								if( ($i != 0) && ($i % 2 == 0)) echo "</tr> ";
								endif;
							}
					?>
							</table>
					<?php
						}
					?>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card card-stats" style="background-color: #dff9fb">
					<div class="card-header card-header-default card-header-icon" style="text-align: center;">
						<h3 class="card-title" style="color: #54a0ff; font-weight: bold;">
							You May Like
						</h3>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div>
					<?php
						$i = 0;
						if ($only_users) {
					?>
							<table>
								<tr>
					<?php
							foreach ($only_users as $key)
							{
								if($key['id'] != userStorageData()->profileId):
					?>
								<td width="550">
									<div style="margin-right: 8%; margin-left: 6%; margin-bottom: 8%">
										<div class="card card-stats">
											<div class="card-header card-header-default card-header-icon">
							                  	<div class="col-sm-12 col-md-12" style="padding-left: 0px">
													<div class="card-icon">
								                  		<?php
								                  			if ($key['photo']) {
								                  		?>
								                  				<img src="<?php echo base_url('').'/'.$key['photo'] ?>" alt="..." width="110" height="120">
								                  		<?php
								                  			} 
								                  			else {
								                  		?>
								                  				<img src="<?php echo base_url('assets/img/no-image3.jpg') ?>" width="110" height="120">
								                  		<?php	
								                  			}	
								                  		?>
							                  		</div>
												</div>
							                  	<div class="col-sm-12 col-md-12" style="padding-right: 0px">
													<h3 class="card-title">
										                <?php 
										                	echo $key['firstName'] .' '.$key['lastName'];
										                ?>
							                  		</h3>
												</div>
							                  	<div class="col-sm-12 col-md-12" style="padding-right: 0px">
							                  		<p class="card-category">
							                  			E-mail: <?php echo $key['email'] ?>
							                  		</p>
							                  	</div>
							                </div>
											<div class="card-footer">
												<a style="cursor: pointer; color: white;" class="btn btn-md btn-block btn-info" onclick="followUser(<?php echo $key['mutualID'] ?>)">
													<span id="<?php echo 'followUser-'.$key['mutualID'] ?>"><b>follow</b></span>
												</a>
											</div>
										</div>
									</div>
								</td>
					<?php
								$i++;
								if( ($i != 0) && ($i % 2 == 0)) echo "</tr> ";
								endif;
							}
					?>
							</table>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>