  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo HTTP_IMAGES_PATH;?>img1.jpg" alt="Chania" width="460" height="600">
        <div class="carousel-caption">
    <h3><a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary btn-lg">SUBSCRIBE NOW</button></a></h3>
 </div>
      </div>

      <div class="item">
        <img src="<?php echo HTTP_IMAGES_PATH;?>img2.jpg" alt="Chania" width="460" height="600">
         <div class="carousel-caption">
    <h3><a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary btn-lg">SUBSCRIBE NOW</button></a></h3>
 </div>
      </div>
    
      <div class="item">
        <img src="<?php echo HTTP_IMAGES_PATH;?>img3.jpg" alt="Flower" width="460" height="600">
         <div class="carousel-caption">
    <h3><a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary btn-lg">SUBSCRIBE NOW</button></a></h3>
 </div>
      </div>

      <div class="item">
        <img src="<?php echo HTTP_IMAGES_PATH;?>img4.jpg" alt="Flower" width="460" height="600">
         <div class="carousel-caption">
    <h3><a href="#"><button type="button" class="btn btn-primary btn-lg">SUBSCRIBE NOW</button></a></h3>
 </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>