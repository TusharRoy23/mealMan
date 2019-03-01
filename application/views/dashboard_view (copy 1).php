    <style type="text/css">
    .dropzone {
      background: #fff;
      border: 2px dashed #ddd;
      border-radius: 5px;
    }

    .dz-message {
      color: #999;
    }

    .dz-message:hover {
      color: #464646;
    }

    .dz-message h3 {
      font-size: 200%;
      margin-bottom: 15px;
    }
    .dz-remove
    {
        display:inline-block !important;
        width:1.2em;
        height:1.2em;
        
        position:absolute;
        top:5px;
        right:5px;
        z-index:1000;
        
        font-size:1.2em !important;
        line-height:1em;
       
        text-align:center;
        font-weight:bold;
        border:1px solid gray !important;
        border-radius:1.2em;
        color:gray;
        background-color:white;
        opacity:.5;
        
    }

    .dz-remove:hover
    {
        text-decoration:none !important;
        opacity:1;
    }
    .dz-progress {
       /*progress bar covers file name*/ 
      display: none !important;
    }
    </style>
    <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="">
          <form enctype="multipart/form-data" class="post_submit" id="dropzoneFrom">
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
            <a class="fancybox" rel="gallery1" href="http://farm2.staticflickr.com/1669/23976340262_a5ca3859f6_b.jpg" title="Twilight Memories (doraartem)">
  <img src="http://farm2.staticflickr.com/1669/23976340262_a5ca3859f6_m.jpg" alt="" />
</a>
<a class="fancybox" rel="gallery1" href="http://farm2.staticflickr.com/1459/23610702803_83655c7c56_b.jpg" title="Electrical Power Lines and Pylons disappear over t.. (pautliubomir)">
  <img src="http://farm2.staticflickr.com/1459/23610702803_83655c7c56_m.jpg" alt="" />
</a>
<a class="fancybox" rel="gallery1" href="http://farm2.staticflickr.com/1617/24108587812_6c9825d0da_b.jpg" title="Morning Godafoss (Brads5)">
  <img src="http://farm2.staticflickr.com/1617/24108587812_6c9825d0da_m.jpg" alt="" />
</a>
<a class="fancybox" rel="gallery1" href="http://farm4.staticflickr.com/3691/10185053775_701272da37_b.jpg" title="Vertical - Special Edition! (cedarsphoto)">
  <img src="http://farm4.staticflickr.com/3691/10185053775_701272da37_m.jpg" alt="" />
</a>
          <?php
            if ($feeds) {
              foreach ($feeds as $key)
              {
          ?>
                <div style="margin-bottom: 2%">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="form-group">
                        <?php
                          if ($key['profilePic']) {
                            $profilePic = base_url('').'/'.$key['profilePic'];
                          } 
                          else {
                            $profilePic = base_url('assets/img/no-image-face.png');
                          }
                        ?>
                      <label class="col-lg-6 col-md-6 col-sm-12" style="float: left;">
                        <?php
                          if (userStorageData()->profileId === $key['newsFeedsProfileId']) {
                            echo '<h4><img src="'.$profilePic.'" alt="..." style="border-radius: 50%;" height="40" width="40"> <b>Me</b></h4>';
                          }
                          else
                            echo '<h4><img src="'.$profilePic.'" alt="..." style="border-radius: 50%;" height="40" width="40"> <b>'.ucfirst($key['firstname']).' '.ucfirst($key['lastname']).'</b></h4>';
                        ?>
                      </label>
                      <label class="col-lg-6 col-md-6 col-sm-12" style="text-align: right;">
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
                        <?php
                          if ($key['newsFeedsFiles']) {
                            $array = json_decode($key['newsFeedsFiles']);
                        ?>
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                <?php
                                  for($i = 0; $i < sizeof(json_decode($key['newsFeedsFiles'])); $i++){
                                ?>
                                    
                                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active': ''; ?>"></li>
                                <?php
                                  }
                                ?>
                                </ol>
                                <div class="carousel-inner">
                                <?php

                                    for($i = 0; $i < sizeof(json_decode($key['newsFeedsFiles'])); $i++){
                                      if($key['fileType'] == 1):
                                ?>
                                      
                                          <div class="carousel-item <?php echo $i == 0 ? 'active': ''; ?>">
                                            <a href="<?php echo base_url('').$array[$i] ?>" class="fancybox-thumb" rel="fancybox-thumb">
                                              <img class="d-block w-100" height="500" src="<?php echo base_url('').$array[$i] ?>">
                                            </a>
                                            
                                          </div>
                                <?php
                                      else:
                                ?>
                                        <div>
                                            <a class="fancybox" href="<?php echo base_url('').$array[$i] ?>">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </a>
                                        </div>

                                <?php
                                      endif;
                                    }
                                ?>
                                </div>
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                        <?php
                          }
                        ?>
                        

                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <label class="col-lg-6 col-md-6 col-sm-6">
                      <div class="stats" id="<?php echo 'likeBtn-'.$key['newsFeedsId'] ?>" style="text-align: center;">
                        <a style="cursor: pointer;" onclick="postLikes(<?php echo $key['newsFeedsId'] ?>)">
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
                          <span id="<?php echo 'likes-'.$key['newsFeedsId'] ?>">(<?php echo $key['likes'] ?>)</span> <i class="fa fa-thumbs-up" id="<?php echo 'thumbs-'.$key['newsFeedsId'] ?>" style="font-size:30px; color: <?php echo $color ?>"></i>
                        </a>
                      </div>
                    </label>
                    <label class="col-lg-3 col-md-6 col-sm-6">
                      <div class="stats" style="text-align: center;">
                        <a style="cursor: pointer;">
                          <i class="fa fa-comments" style="font-size:30px"></i>
                        </a>
                      </div>
                    </label>
                  </div>
                </div>
          <?php
              }
            }
          ?>
          </div>
        </div>
      </div>
		</div>
	</div>
</div>