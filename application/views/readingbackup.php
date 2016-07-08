<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
  <title>E Magazine</title>
 <!--js-->  
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>
   <script src="<?php echo HTTP_JS_PATH; ?>defaultjs.js"></script>
    <!--css-->  
   <link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet">
<!--BOOTSTREP-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet"
href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/js/bootstrap.min.js" ></script>
 <!--font awesome-->
<link rel="stylesheet" 
href="<?php echo HTTP_ASSETS_PATH;?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo HTTP_JS_PATH; ?>jquery.min.js"></script>
<!--<script src="http://lab.iamrohit.in/js/location.js"></script>-->
<script src="<?php echo HTTP_JS_PATH; ?>location.js"></script>
 
  
 
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>hash.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>magazine.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>magazine.css"></link>
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style1.css"></link>


</head>
<body>
<header style="background:#fff;">

<div style="padding:15px">

<span id="logo">
<a href="<?php echo BASE_URL; ?>"><img src="<?php echo HTTP_IMAGES_PATH;?>logo.png" /></a>
</span>
<?php    if ($this->session->userdata('is_client_login')) { ?>
<div class="loggedin"><a href="<?php echo BASE_URL ?>myaccount"><?php  echo   strtoupper($this->session->userdata('user_name')); ?></a></div>
<?php } else {?>
<div class="loggedin"><a >&nbsp;</a></div>

<?php } ?>
<span id="menu">
<?php    if (!$this->session->userdata('is_client_login')) { ?>
<!--login button-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-login-modal-sm">LOGIN</button>
  <?php } else { ?>

<!--logout button-->
<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>home/logout">
<button type="submit" class="btn btn-primary" >LOGOUT</button>
</form>

  <?php } ?>


<div class="modal fade bs-login-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    
      <form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>home/do_login">
     <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="emailid" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
    </div>
  </div>
 
   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <label><a href="<?php echo BASE_URL ?>forgotpassword" >Forgot Password</a></label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-primary">Login</button>
    </div>
     <div class="col-sm-offset-2 col-sm-10">
    <p>New user please click <a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary">Sign in</button></a></p>
    </div>
  </div>
</form>
    </div>
  </div>
</div>


</span><!--//menu-->

</div>

</header>  
 
<div class="container editions" style=" max-width:800px !important;">
<div class="row">
		<div class="magazine-viewport">
	<div class="container">
		<div class="magazine" style="position:relative; left:0px;">
			<!-- Next button -->
			<div ignore="1" class="next-button"></div>
			<!-- Previous button -->
			<div ignore="1" class="previous-button"></div>
		</div>
	</div>
</div>
<!-- Thumbnails -->
		<div class="thumbnails">
	<div>
		<ul>
			<li class="i">
				<img src="<?php echo base_url()?>pdftoimg/pages/1-thumb.jpg" width="76" height="100" class="page-1">
				<span>1</span>
			</li>
			<li class="d">
				<img src="<?php echo base_url()?>pdftoimg/pages/2-thumb.jpg" width="76" height="100" class="page-2">
				<img src="<?php echo base_url()?>pdftoimg/pages/3-thumb.jpg" width="76" height="100" class="page-3">
				<span>2-3</span>
			</li>
			<li class="d">
				<img src="<?php echo base_url()?>pdftoimg/pages/4-thumb.jpg" width="76" height="100" class="page-4">
				<img src="<?php echo base_url()?>pdftoimg/pages/5-thumb.jpg" width="76" height="100" class="page-5">
				<span>4-5</span>
			</li>
			<li class="d">
				<img src="<?php echo base_url()?>pdftoimg/pages/6-thumb.jpg" width="76" height="100" class="page-6">
				<img src="<?php echo base_url()?>pdftoimg/pages/7-thumb.jpg" width="76" height="100" class="page-7">
				<span>6-7</span>
			</li>
			<li class="d">
				<img src="<?php echo base_url()?>pdftoimg/pages/8-thumb.jpg" width="76" height="100" class="page-8">
				<img src="<?php echo base_url()?>pdftoimg/pages/9-thumb.jpg" width="76" height="100" class="page-9">
				<span>8-9</span>
			</li>
			<li class="d">
				<img src="<?php echo base_url()?>pdftoimg/pages/10-thumb.jpg" width="76" height="100" class="page-10">
				<img src="<?php echo base_url()?>pdftoimg/pages/11-thumb.jpg" width="76" height="100" class="page-11">
				<span>10-11</span>
			</li>
			<li class="i">
				<img src="<?php echo base_url()?>pdftoimg/pages/12-thumb.jpg" width="76" height="100" class="page-12">
				<span>12</span>
			</li>
		</ul>
	</div>	
</div>
</div>
</div>	
<div id="footer"><?php $this->load->view('vwFooter');?></div>
<script type="text/javascript">

function loadApp() {
$(document).ready(function(e) {
    $(document).dblclick(function(e) {
        $('#footer').hide();
    });
});
 //$('#all').fadeIn(1000);
	
        $('#all').hide("margin-top:250px")


	// Create the flipbook

	$('.magazine').turn({
			
			// Magazine width

			width: 1024,

			// Magazine height

			height: 600,

			// Elevation will move the peeling corner this number of pixels by default

			elevation: 50,
			
			// Hardware acceleration

			acceleration: !isChrome(),

			// Enables gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true,

			// The number of pages

			pages: 12,


			// Events
			when: {

			turning: function(event, page, view) {
				
				var book = $(this),
				currentPage = book.turn('page'),
				pages = book.turn('pages');
		
				// Update the current URI

				Hash.go('page/' + page).update();


				// Show and hide navigation buttons

				disableControls(page);
				

				$('.thumbnails .page-'+currentPage).
					parent().
					removeClass('current');

				$('.thumbnails .page-'+page).
					parent().
					addClass('current');

			},

			turned: function(event, page, view) {

				disableControls(page);

				$(this).turn('center');

				if (page==1) { 
					$(this).turn('peel', 'br');
				}

			},

			missing: function (event, pages) {

				// Add pages that aren't in the magazine

				for (var i = 0; i < pages.length; i++)
					addPage(pages[i], $(this));

			}
		}

	});

	// Zoom.js

	$('.magazine-viewport').zoom({
		flipbook: $('.magazine'),
		max: function() { 
			
			return largeMagazineWidth()/$('.magazine').width();

		}, 
		when: {
			tap: function(event) {

				if ($(this).zoom('value')==1) {
					$('.magazine').
						removeClass('animated').
						addClass('zoom-in');
					$(this).zoom('zoomIn', event);
				} else {
					$(this).zoom('zoomOut');
				}
			},

			resize: function(event, scale, page, pageElement) {

				if (scale==1)
					loadSmallPage(page, pageElement);
				else
					loadLargePage(page, pageElement);

			},

			zoomIn: function () {
				
				$('.thumbnails').hide();
				$('.made').hide();
				$('#footer').hide();
				$('.magazine').addClass('zoom-in');

				if (!window.escTip && !$.isTouch) {
					escTip = true;

					$('<div />', {'class': 'esc'}).
						html('<div>Press ESC to exit</div>').
							appendTo($('body')).
							delay(2000).
							animate({opacity:0}, 500, function() {
								$(this).remove();
							});
				}
			},

			zoomOut: function () {

				$('.esc').hide();
				$('.thumbnails').fadeIn();
				$('.made').fadeIn();

				setTimeout(function(){
					$('.magazine').addClass('animated').removeClass('zoom-in');
					resizeViewport();
				}, 0);

			},

			swipeLeft: function() {

				$('.magazine').turn('next');

			},

			swipeRight: function() {
				
				$('.magazine').turn('previous');

			}
		}
	});

	// Using arrow keys to turn the page

	$(document).keydown(function(e){

		var previous = 37, next = 39, esc = 27;

		switch (e.keyCode) {
			case previous:

				// left arrow
				$('.magazine').turn('previous');
				e.preventDefault();

			break;
			case next:

				//right arrow
				$('.magazine').turn('next');
				e.preventDefault();

			break;
			case esc:
				
				$('.magazine-viewport').zoom('zoomOut');	
				e.preventDefault();

			break;
		}
	});

	// URIs - Format #/page/1 

	Hash.on('^page\/([0-9]*)$', {
		yep: function(path, parts) {
			var page = parts[1];

			if (page!==undefined) {
				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.magazine').turn('is'))
				$('.magazine').turn('page', 1);
		}
	});


	$(window).resize(function() {
		resizeViewport();
	}).bind('orientationchange', function() {
		resizeViewport();
	});

	// Events for thumbnails

	$('.thumbnails').click(function(event) {
		
		var page;

		if (event.target && (page=/page-([0-9]+)/.exec($(event.target).attr('class'))) ) {
		
			$('.magazine').turn('page', page[1]);
		}
	});

	$('.thumbnails li').
		bind($.mouseEvents.over, function() {
			
			$(this).addClass('thumb-hover');

		}).bind($.mouseEvents.out, function() {
			
			$(this).removeClass('thumb-hover');

		});

	if ($.isTouch) {
	
		$('.thumbnails').
			addClass('thumbanils-touch').
			bind($.mouseEvents.move, function(event) {
				event.preventDefault();
			});

	} else {

		$('.thumbnails ul').mouseover(function() {

			$('.thumbnails').addClass('thumbnails-hover');

		}).mousedown(function() {

			return false;

		}).mouseout(function() {

			$('.thumbnails').removeClass('thumbnails-hover');

		});

	}


	// Regions

	if ($.isTouch) {
		$('.magazine').bind('touchstart', regionClick);
	} else {
		$('.magazine').click(regionClick);
	}

	// Events for the next button

	$('.next-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('next-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('next-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('next-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('next-button-down');

	}).click(function() {
		
		$('.magazine').turn('next');

	});

	// Events for the next button
	
	$('.previous-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('previous-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('previous-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('previous-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('previous-button-down');

	}).click(function() {
		
		$('.magazine').turn('previous');

	});


	resizeViewport();

	$('.magazine').addClass('animated');

}


 $('#all').hide();


// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['assets/js/turn.min.js'],
	nope: ['assets/js/turn.html4.min.js'],
	both: ['assets/js/zoom.js'],
	complete: loadApp
});

</script>

</body>
</html>