jQuery(document).ready(function($){

//Check to see how wide the screen is
//Setup variables to hold our sizes
var wW;
//var windowWidth = $(window).width();
//console.log(windowWidth);
var _windowWidth;
var $clk = 0;
function mobileNav(){

	$('#mobileMenuTrigger').click(function(){
		$clk++;
		//console.log($clk);
	    if($clk == 1){
	    	$('.main-navigation > ul').slideDown();
	    }else{
	    	$('.main-navigation > ul').slideUp();
	    	$clk = 0;
	    }
	  
	  $('.main-navigation ul li > a').on("click", function(){
	     $('.main-navigation ul').slideUp();
	  });
	});
	$('.sub-trigger').click(function(){
	 	$(this).parent().find('.sub-menu').slideToggle();
	});

	console.log("Nav Open");
}

mobileNav();

function desktopNav(){
	$('.main-navigation > ul').show();
	$('.sub-menu').show();
	$clk = 0;
}

//Responive styling functions

//1) Set the variables to hold our values
var $wW;

//Grab the width or height of each element
function gi_resize(){
  $wW = $(window).width();
}
//Run the function above at document ready and on a window resize event
//__ Pull our variables into each function
 $(document).ready(gi_resize($wW));
 $(window).resize(gi_resize($wW));

//Apply our widths or heigths of selected elements either on load, or on resize
function _resize(){

  //Run the funciton again to get the current size for use in our _resize function
  //__ Pull our variables into each function
  gi_resize($wW);
  $(window).resize(gi_resize($wW));

  //Console log anything that isn't working here

  //---------------------

  //Write some code to do things with our variables
  if($wW > 1200){
  	desktopNav();
  }

  if($wW < 1200){
  	$('.main-navigation > ul').hide();
	$clk = 0;
  }

}

//Run the function on load & on resize
_resize();
$(window).resize(_resize);

});
