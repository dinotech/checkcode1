<html>
<head>
<meta name="viewport" content="width = 1050, user-scalable = no" />
<link rel="icon" type="image/png" href="http://itrportfolio.com/pdftoimg/turnjs4/samples/magazine/pics/favicon.png" />
 <script type="text/javascript" src="http://itrportfolio.com/pdftoimg/turnjs4/extras/jquery.min.1.7.js"></script> 
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH; ?>extras/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH; ?>extras/jquery.mousewheel.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>defaultjs.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/js/bootstrap.min.js" ></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.min.js"></script>
<!--<script src="http://lab.iamrohit.in/js/location.js"></script>-->
<script src="<?php echo HTTP_JS_PATH; ?>location.js"></script>
<!-- turn.js files -->
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH; ?>lib/hash.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>admin/magazine.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>magazine.css"></link>
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style1.css"></link>
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap.min.css" >
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet"href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH;?>font-awesome/css/font-awesome.min.css">

</head>
<body>
<?php  $this->load->view('admin/my_header.php');?>
<?php if(isset($_GET['action']) &&$_GET['action']=='verify' || $_GET['action']=='new'){?>
<div class="col-sm-8 col-sm-offset-2" style="text-align:center; margin-top:20px;">
<input type="hidden" id="magid" value="<?php echo $_GET['id']?>">
<input type="hidden" id="magname" value="<?php echo $_GET['mag']?>">
     <button class="btn btn-success" onClick="publish()">Publish</button>
     <button class="btn btn-danger"  onclick="canceling()" style="margin-left:10px;">Cancel</button>
</div>
<?php } ?>

<div style="background:#999; padding-top:10px; padding-bottom:80px;">

<div class="container editions" style="margin-left:-3%;">
<div class="magazine-viewport" style="padding-top:0px;">
	<div class="container">
		<div class="magazine">
			<!-- Next button -->
			<div ignore="1" class="next-button"></div>
			<!-- Previous button -->
			<div ignore="1" class="previous-button"></div>
		</div>
	</div>
</div>
</div>
<?php
$split = explode('.',$_GET['mag']);
$mag_name= '/home/itrportf/public_html/emagazine/assets/pdf/'.$split[0];

define('IMAGEPATH',$mag_name.'/');

//echo IMAGEPATH;
//die;

if(is_dir(IMAGEPATH)){
    $handle = opendir(IMAGEPATH);
	}
else{
    echo '<div align="center" style="color:#fff;"><h1>NO PDF FOUND</h1><div>';
}
 

$images = glob(IMAGEPATH."*.jpg");?>
<!-- Thumbnails -->
<div  style=" width:100%;margin:0px auto; margin-top:-15px;padding-top:-20px; max-height:100px;">
<div class="thumbnails" style="position:relative;top:-10px;margin-bottom:30px;">
<ul> 
<?php
//Display image using loop
if(fmod(count($images),2)==1){
$cmo=count($images)-1;
}else if(fmod(count($images),2)==0){
$cmo=count($images);
}?>

<div id="total_pages"><?php echo count($images); ?></div>
<div id="pdf"><?php echo 'emagazine/assets/pdf/'.$split[0]; ?></div>
<?php
 


for($index=0;$index<count($images);$index++)
{	


//echo "<pre>";print_r($images);

$image=explode("/",$images[$index]);

//echo "<pre>";print_r($image);



if($index==0 ){
echo '<li class="i"><img src="http://itrportfolio.com/emagazine/assets/pdf/'.$image[7]."/".$image[8].'" width="76" height="100" class="page-1"><span>'.($index+1).'</span></li>';
}
else {
echo '<li class="d">
<img src="http://itrportfolio.com/emagazine/assets/pdf/'.$image[7]."/".$image[8].'" width="76" height="100" class="page-'.$index.'">
<img src="http://itrportfolio.com/emagazine/assets/pdf/'.$image[7]."/".$image[8].'" width="76" height="100" class="page-'.($index+1).'">
<span>'.($index+1).'-'.(($index++)+2).'</span></li>';
}
}

?>
</ul>
</div></div>
<input type="hidden" id="page" value="<?php if(isset($_GET['page'])){echo $_GET['page'];}?>">
<input type="hidden" id="lastid" value="<?php if(isset($_GET['last'])){echo $_GET['last'];}?>">
<input type="hidden" id="preid" value="<?php if(isset($_GET['pre'])){echo $_GET['pre'];}?>">
</div></body>
</html>
<script type="text/javascript">

function loadApp() {

 
 var mag=$('#pdf').html();
//alert(mag);

 $('#all').fadeIn(1000);
	
     $('#all').css("margin-top:40%")


	// Create the flipbook

	$('.magazine').turn({
			
			// Magazine width

			width: 922,

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

			pages: $('#total_pages').html(),


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
					addPage(pages[i], $(this),mag);

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
                        var mag=$('#pdf').html();
				if (scale==1)
					loadSmallPage(page, pageElement,mag);
				else
					loadLargePage(page, pageElement,mag);

			},

			zoomIn: function () {
				
				$('.thumbnails').hide();
				$('.made').hide();
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
	yep: ['<?php echo HTTP_ASSETS_PATH; ?>lib/turn.min.js'],
	nope: ['<?php echo HTTP_ASSETS_PATH; ?>lib/turn.html4.min.js'],
	both: ['<?php echo HTTP_ASSETS_PATH; ?>lib/zoom.min.js'],
	complete: loadApp
});

function publish()
{ 
var magname=$('#magname').val();
var parid = $('#magid').val();
var lastid = $('#lastid').val();
var preid = $('#preid').val();
if($('#page').val()=='republish')
  { 
      $.ajax({
            url:'read/republishingis',
            type:'post',
            data:{last:lastid, pre:preid},
            success:function(data){
               if(data==1)
               {                                     
                    window.location.href="magazine/manage_magz?magzid="+$('#magid').val()+"";         
                   
               }
           }
      });
   }
   else if($('#page').val()=='supplemented')
  { 
      $.ajax({
            url:'read/issupplementing',
            type:'post',
            data:{last:lastid, pre:preid},
            success:function(data){
               if(data==1)
               {                                     
                    window.location.href="magazine/manage_magz?magzid="+$('#magid').val()+"";         
                   
               }
           }
      });
   }
   else if($('#page').val()=='new')
  { 
      $.ajax({
            url:'read/newpublish',
            type:'post',
            data:{last:lastid},
            success:function(data){
               if(data==1)
               {                                     
                    window.location.href="magazine/manage_magz?magzid="+$('#magid').val()+"";         
                   
               }
           }
      });
   }
   else                  
   {    
      $.ajax({
            url:'read/ispublishing',
            type:'post',
            data:{name:magname,parentid:parid},
            success:function(data){
               if(data==1)
               {          
                    window.location.href="magazine/republish?magzid="+$('#magid').val()+"";         
                   
               }
           }
     });
   }
}

function canceling()
{
var magname=$('#magname').val();
var parid = $('#magid').val();
var lastid = $('#lastid').val();
var preid = $('#preid').val();
if($('#page').val()=='republish')
  {                      
   $.ajax({
            url:'read/cancelling1',
            type:'post',
            data:{last:lastid, pre:preid},
            success:function(data){
            if(data==1){     
           window.location.href="magazine/republish?magzid="+$('#magid').val()+"";

           }}
     })
  }
else if($('#page').val()=='supplemented')
  {                      
   $.ajax({
            url:'read/cancelling1',
            type:'post',
            data:{last:lastid, pre:preid},
            success:function(data){
            if(data==1){     
           window.location.href="magazine/supplement?magzid="+$('#magid').val()+"";

           }}
     })
  }  
else
  {
    $.ajax({
            url:'read/cancelling',
            type:'post',
            data:{name:magname,parentid:parid},
            success:function(data){
            if(data==1){     
           window.location.href="magazine/upload_edition?magzid="+$('#magid').val()+"";

           }}
     })
  }
}
</script>

</body>
</html>