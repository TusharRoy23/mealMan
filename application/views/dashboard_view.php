    <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="dashboard">
          <form enctype="multipart/form-data" id="dropzoneFrom">
            <div class="card-header card-header-warning card-header-icon">
              <div class="form-group">
                <textarea class="form-control description" name="description" rows="5"></textarea>
              </div>
              <div id="image-dropzone" class="dropzone image_dropzone" style="display: none;">
                <div class="dz-message">
                  <h3>Drop Images here</h3> or <strong>click</strong> to upload
                </div>
              </div>
              <div id="file-dropzone" class="dropzone file_dropzone" style="display: none;">
                <div class="dz-message">
                  <h3>Drop Files here</h3> or <strong>click</strong> to upload
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="stats">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <label class="col-lg-4 col-md-4 col-sm-4">
                    <div style="float: left; margin-right: 6%">
                      <a style="cursor: pointer;" class="image_click">
                        <i class="fa fa-file-image-o" aria-hidden="true" title="Image Upload" style="font-size: 28px"></i>
                      </a>
                    </div>
                    <div>
                      <a style="cursor: pointer;" class="file_click">
                        <i class="fa fa-file" aria-hidden="true" title="File Upload" style="font-size: 28px"></i>
                      </a>
                    </div>
                  </label>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="stats">
                <input type="submit" name="submit" style="color:#f5f6fa" class="btn btn-lg btn-block btn-primary" value="Post" id="submit-all">
              </div>
            </div>
          </form>
          <div class="feedDiv">
          <?php
            if ($feeds) {
              $j = 1;
              foreach ($feeds as $key)
              {
          ?>
                <div style="margin-bottom: 2%">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="form-group">
                        <?php
                          if ($key['profilePic']) {
                            $profilePic = base_url('').$key['profilePic'];
                          } 
                          else {
                            $profilePic = base_url('assets/img/no-image-face.png');
                          }
                        ?>
                      <label class="col-lg-6 col-md-6 col-sm-6" style="float: left;">
                        <?php
                          if (userStorageData()->profileId === $key['newsFeedsProfileId']) {
                            echo '<h4><img src="'.$profilePic.'" alt="..." style="border-radius: 50%;" height="40" width="40"> <b>Me</b></h4>';
                          }
                          else
                            echo '<h4><img src="'.$profilePic.'" alt="..." style="border-radius: 50%;" height="40" width="40"> <b>'.ucfirst($key['firstname']).' '.ucfirst($key['lastname']).'</b></h4>';
                        ?>
                      </label>
                      <label class="col-lg-6 col-md-6 col-sm-6" style="text-align: right;">
                        <?php echo '<h4>Said at '.$key['newsFeedsCreationDate'].'</h4>'; ?>
                      </label>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <br>
                        <?php echo $key['newsFeedsDescription'] ?>
                        <br>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="colll">
                          <?php
                            if ($key['newsFeedsFiles']) {
                              
                              $array = json_decode($key['newsFeedsFiles']);
                              for($i = 0; $i < sizeof(json_decode($key['newsFeedsFiles'])); $i++){
                                if($key['fileType'] == 1 && $array[$i]){
                          ?>
                                  <a href="<?php echo base_url('').$array[$i] ?>" class="fancybox-thumb" rel="group<?php echo $j; ?>" >
                                    <img height="100" width="100" src="<?php echo base_url('').$array[$i] ?>">
                                  </a>
                          <?php
                                }
                                elseif ($key['fileType'] == 2 && $array[$i]) {
                          ?> 
                                  <a class="various fancybox.iframe" href="<?php echo base_url('').$array[$i] ?>" rel="group<?php echo $j; ?>">
                                    <i class="fa fa-floppy-o" aria-hidden="true" style="font-size: 100px;"></i>
                                  </a>
                          <?php
                                }
                              }
                              $j++;
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <?php 
                        if (userStorageData()->profileId == $key['newsFeedsProfileId']) {
                          $footer_class = "col-lg-4 col-md-4 col-sm-2";
                        }
                        else{
                          $footer_class = "col-lg-6 col-md-6 col-sm-3";
                        }
                      ?>
                      <label class="<?php echo $footer_class ?>">
                        <div class="stats" id="<?php echo 'likeBtn-'.$key['newsFeedCustomId'] ?>" style="text-align: center;">
                          <a style="cursor: pointer;" title="Likes" onclick="postLikes('<?php echo $key['newsFeedCustomId'] ?>')">
                            <?php
                              $array = array(
                                'feedID' => $key['newsFeedsId'],
                                'db' => 'newsFeedsLikes'
                              );
                              if (dbResultCheck($array)) {
                                $color = "#e056fd";
                              }
                              else{
                                $color = "";
                              }
                            ?>
                            <span id="<?php echo 'likes-'.$key['newsFeedCustomId'] ?>">(<?php echo $key['likes'] ?>)</span> <i class="fa fa-thumbs-up" id="<?php echo 'thumbs-'.$key['newsFeedCustomId'] ?>" style="font-size:30px; color: <?php echo $color ?>"></i>
                          </a>
                        </div>
                      </label>
                      <label class="<?php echo $footer_class ?>">
                        <div class="stats" style="text-align: center;">
                          <a style="cursor: pointer;" title="Comments">
                            <i class="fa fa-comments" style="font-size:30px"></i>
                          </a>
                        </div>
                      </label>
                      <?php
                        if (userStorageData()->profileId == $key['newsFeedsProfileId']){
                      ?>
                          <label class="<?php echo $footer_class ?>">
                            <div class="stats" style="text-align: center;">
                              <a href="#" id="navbarDropdownProfile" title="Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear" style="font-size:30px"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="<?php echo base_url('Dashboard-Post-Edit').'/'.$key['newsFeedCustomId'] ?>">Edit</a>
                                <a class="dropdown-item" style="cursor: pointer;" onclick="deleteFeed('<?php echo $key["newsFeedCustomId"] ?>')">Delete</a>
                              </div>
                            </div>
                          </label>
                      <?php
                        }
                      ?>
                    </div>
                  </div>
                </div>
          <?php
              }
            }
          ?>
          </div>
        </div>
      </div>
      <div class="">
        <div id="dialog-confirm" title="Delete your Feed ?" style="display: none;">
          <p><i class="fa fa-warning" style="font-size:24px"></i> Are you sure?</p>
        </div>
      </div>
		</div>
	</div>
</div>
