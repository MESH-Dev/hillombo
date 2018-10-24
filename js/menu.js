jQuery(document).ready(function($){
   $('#mobileMenuTrigger').click(function(){
      $('.main-navigation ul').slideToggle();
      $('.main-navigation ul li > a').on("click", function(){
         $('.main-navigation ul').slideUp();
      });
   });
});
