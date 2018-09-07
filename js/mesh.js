// var scrollLinks = document.querySelectorAll('header a');
//
// for (var i = 0; i < scrollLinks.length; i++) {
//    scrollLinks[i].addEventListener('click', function(event){
//       event.preventDefault();
//       var scrollId = this.href.split('#')[1];
//       document.getElementById(scrollId).scrollIntoView({
//          behavior: 'smooth',
//          block: 'center'
//       });
//    });
// }

var welcomeAnim = new TimelineMax(),
   footerAnim = new TimelineMax(),
   controller = new ScrollMagic.Controller(),
   welcomeTitle = document.getElementById('welcomeTitle'),
   welcomeDesc = document.getElementById('welcomeDesc'),
   scrollLink = document.getElementById('scrollLink'),
   mainPanels = document.getElementsByClassName('panel'),
   navItems =  document.getElementById('main-nav').getElementsByTagName('ul')[0].getElementsByTagName('a'),
   introPanels = document.getElementsByClassName('panel intro'),
   cardPanels = document.getElementsByClassName('panel cards'),
   textPanels = document.getElementsByClassName('panel wysiwyg'),
   footerLeft = document.getElementById('left-col'),
   footerRight = document.getElementById('right-col');

jQuery(document).ready(function($){

  $('a[href*=#]:not([href=#])').click(function() {
       if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
           || location.hostname == this.hostname) {

           var target = $(this.hash);
           target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                    scrollTop: (target.offset().top - 60)
               }, 600);
               return false;
           }
       }
   });

   // $('#mobileMenuTrigger').click(function(){
   //    $('.main-navigation ul').slideToggle();
   // });
   
   $('#scrollLink').click(function(){
      var dist = ($('#top').outerHeight()) - 60;
      $('html,body').animate({
         scrollTop: (dist)
      }, 600);
   });

   //Taken from https://jsfiddle.net/cse_tushar/Dxtyu/141/
   //This does not fire for the footer (contact section).
   // $(document).on("scroll", onScroll);
   //
   // function onScroll(event){
   //     var scrollPos = $(document).scrollTop();
   //     $('.main-navigation a').each(function () {
   //         var currLink = $(this);
   //         var currLi = $(this).parent('li');
   //         var refElement = $(currLink.attr("href"));
   //         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
   //             $('.main-navigation ul li').removeClass("active");
   //             currLi.addClass("active");
   //         }
   //         else{
   //             currLi.removeClass("active");
   //         }
   //     });
   // }

});

//Landing & Scroll Animations

welcomeAnim.set(welcomeTitle, {css:{transform:"translateY(40px)", opacity:0}})
   .set(welcomeDesc, {css:{transform:"translateY(30px)", opacity:0}})
   .set(scrollLink, {css:{opacity:0}})
   .to(welcomeTitle, 0.5, {css:{transform:"translateY(0px)", opacity:1}, ease: Power3.easeInOut, delay: 0.4})
   .to(welcomeDesc, 0.5, {css:{transform:"translateY(0px)", opacity:1}, ease: Power2.easeInOut, delay: -0.1})
   .to(scrollLink, 0.5, {css:{opacity:1}, ease: Power2.easeInOut});

if (introPanels) {
   for (var i = 0; i < introPanels.length; i++) {
      var theBlurb = introPanels[i].getElementsByClassName('blurb')[0],
         theCTA = introPanels[i].getElementsByClassName('cta')[0],
         theDesc = introPanels[i].getElementsByClassName('intro-desc')[0],
         introPanelAnim = new TimelineMax();

      //Define Animations
      introPanelAnim.set(theBlurb, {css:{transform:"translateY(30px)", opacity:0}})
         .set(theCTA, {css:{opacity:0}})
         .set(theDesc, {css:{transform:"translateX(30px)", opacity:0}})
         .to(theBlurb, 0.5, {css:{transform:"translateY(0px)", opacity:1}, ease: Power2.easeInOut})
         .to(theDesc, 0.4, {css:{transform:"translateX(0px)", opacity:1}, ease: Power2.easeInOut, delay: -0.2})
         .to(theCTA, 0.25, {css:{opacity:1}, ease: Power2.easeInOut, delay: -0.1});

      //Trigger Animations
      var introScene = new ScrollMagic.Scene({triggerElement: introPanels[i], reverse: false})
         .setTween(introPanelAnim)
         .addTo(controller);
   };
};

if (cardPanels) {
   for (var i = 0; i < cardPanels.length; i++) {
      var theCards = cardPanels[i].getElementsByClassName('card'),
         count = 0,
         cardPanelAnim = new TimelineMax();

      cardPanelAnim.staggerFrom(theCards, 0.5, {css:{transform:"translateY(-30px)", opacity:0}, ease: Power2.easeInOut}, 0.15);

      var cardScene = new ScrollMagic.Scene({triggerElement: cardPanels[i], reverse: false})
         .setTween(cardPanelAnim)
         .addTo(controller);
   };
};

if (textPanels) {
   for (var i = 0; i < textPanels.length; i++) {
      var theColumns = textPanels[i].getElementsByClassName('content-col'),
         textPanelAnim = new TimelineMax();

      textPanelAnim.staggerFrom(theColumns, 0.5, {css:{transform:"translateX(-30px)", opacity:0}, ease: Power2.easeInOut}, 0.25);

      var textScene = new ScrollMagic.Scene({triggerElement: textPanels[i], reverse: false})
         .setTween(textPanelAnim)
         .addTo(controller);
   };
};

//Define Footer Animations
footerAnim.set(footerLeft, {css:{transform:"translateX(-30px)", opacity:0}})
   .set(footerRight, {css:{transform:"translateX(-30px)", opacity:0}})
   .to(footerLeft, 0.5, {css:{transform:"translateX(0px)", opacity:1}, ease: Power3.easeInOut, delay: 0.4})
   .to(footerRight, 0.5, {css:{transform:"translateX(0px)", opacity:1}, ease: Power2.easeInOut, delay: -0.1});

//Trigger Footer Animations
var footerScene = new ScrollMagic.Scene({triggerElement: ".site-footer", triggerHook: "onEnter", offset: 40, reverse: false})
   .setTween(footerAnim)
   .addTo(controller);

//Scroll-based active nav item class toggling that successfully fires for the footer and allows smoother scrolling.
for (var i = 0; i < navItems.length; i++) {
   var refLink = navItems[i].href.split('#')[1];
   var refElement = document.getElementById(refLink);
   var refHeight = refElement.getBoundingClientRect().height;
   new ScrollMagic.Scene({triggerElement: refElement, duration: refHeight})
            .setClassToggle(navItems[i], "active") // add class toggle
            .addTo(controller);
};
