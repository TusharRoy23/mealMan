		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<?php
					if ($feeds):
				?>
				<div class="dashboard">
					<form enctype="multipart/form-data">
						<div class="card-header card-header-warning card-header-icon">
							<?php
								// echo "<pre>";
								// print_r ($feeds);
								// echo "</pre>";
							?>
							<div class="form-group">
						        <textarea class="form-control edit_description" name="description" rows="5"><?php echo $feeds->newsFeedsDescription ?></textarea>
						    </div>
						    <div id="image-edit-dropzone" class="dropzone image_edit_dropzone" style="display: none;">
						        <div class="dz-message">
						            <h3>Drop Images here</h3> or <strong>click</strong> to upload
						        </div>
						    </div>
						    <div id="file-edit-dropzone" class="dropzone file_edit_dropzone" style="display: none;">
						        <div class="dz-message">
						            <h3>Drop Files here</h3> or <strong>click</strong> to upload
						        </div>
						    </div>
						    <input type="hidden" class="feedId" value="<?php echo $feeds->newsFeedCustomId ?>">
						</div>
						<div class="card-footer">
							<div class="stats">
				                <div class="col-lg-12 col-md-12 col-sm-12">
				                 	<label class="col-lg-4 col-md-4 col-sm-4">
					                    <div style="float: left; margin-right: 6%">
					                      	<a style="cursor: pointer;" class="image_edit_click">
					                        	<i class="fa fa-file-image-o" aria-hidden="true" title="Image Upload" style="font-size: 28px"></i>
					                      	</a>
					                    </div>
					                    <div>
					                      	<a style="cursor: pointer;" class="file_edit_click">
					                        	<i class="fa fa-file" aria-hidden="true" title="File Upload" style="font-size: 28px"></i>
					                      	</a>
					                    </div>
				                  	</label>
				                </div>
				            </div>
						</div>
						<div class="card-footer">
              				<div class="stats">
                				<input type="submit" name="submit" style="color:#f5f6fa" class="btn btn-lg btn-block btn-primary" value="Post" id="submit-edit-all">
              				</div>
            			</div>
            			<div class="card-footer">
            				<div class="row">
            					<label class="col-lg-6 col-md-6 col-sm-3">
	            					<div class="stats" id="<?php echo 'likeBtn-'.$feeds->newsFeedCustomId ?>" style="text-align: center;">
	            						<a style="cursor: pointer;" title="Likes" onclick="postLikes('<?php echo $feeds->newsFeedCustomId ?>')">
	                            			<?php
					                            $array = array(
					                                'feedID' => $feeds->newsFeedsId,
					                                'db' => 'newsFeedsLikes'
					                            );
					                            if (dbResultCheck($array)) {
					                                $color = "#e056fd";
					                            }
					                            else{
					                                $color = "";
					                            }
	                            			?>
	                            			<span id="<?php echo 'likes-'.$feeds->newsFeedCustomId ?>">(<?php echo $feeds->likes ?>)</span> <i class="fa fa-thumbs-up" id="<?php echo 'thumbs-'.$feeds->newsFeedCustomId ?>" style="font-size:30px; color: <?php echo $color ?>"></i>
	                          			</a>
	            					</div>
            					</label>
	            				<label class="col-lg-6 col-md-6 col-sm-3">
	                        		<div class="stats" style="text-align: center;">
	                          			<a style="cursor: pointer;" title="Comments">
	                            			<i class="fa fa-comments" style="font-size:30px"></i>
	                          			</a>
	                        		</div>
	                      		</label>
            				</div>
            			</div>
					</form>
				</div>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
</div>