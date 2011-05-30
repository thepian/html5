$( function() {
   var $page1 = $('#page-1');
   var $page2 = $('#page-2');
   var $page3 = $('#page-3');
   var $page4 = $('#page-4');
   var isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
   var chromeVersion = parseInt(navigator.userAgent.substr(navigator.userAgent.lastIndexOf('Chrome/') + 7, 10));
   $('.learnmore').click(function(e){
     e.preventDefault();
     setTimeout(function(){
   	  $('.contactus, .invisible-fold').show();
   	  $('.contactus, .invisible-fold').css('display','block').css('opacity','0').css('zIndex','100');
     }, 3500);
     play();
     var learnMoreButton = $(this);
     learnMoreButton.fadeOut(1500, function() {
       //learnMoreButton.addClass('hide');
       $('.fold').fadeIn(1500);
     });
     var timeOut = 200;
     if ($.browser.mozilla) {
       timeOut = 2200;
     }
   });
   $('.fold, .invisible-fold').click(function(e){
     e.preventDefault();
     var foldButton = $('.fold');
     foldButton.fadeOut(1500, function() {
       foldButton.addClass('hide');
       $('.learnmore').fadeIn(1500);
     });
     var timeOut = 200;
     if ($.browser.mozilla) {
       timeOut = 2200;
     }
   //$('#page-3').addClass('restart');
     if (Modernizr.csstransforms3d || (isChrome && chromeVersion >= 11)) {
       $('#page-4').addClass('restart');
     	$('.contactus, .invisible-fold').css('opacity','0').css('zIndex','-999');

       setTimeout(function() { $('#page4-content').hide();}, 400);
       setTimeout(function() { $('#page-4').hide();}, 1000);
       setTimeout(function() {   
         $('#page-3').addClass('restart')}, 1000);
       setTimeout(function() {   
       	}, 1800);
       setTimeout(function() { 
       	$('#page-3').hide();}, 2000);   
       setTimeout(function() {   
       	$('#page-2').addClass('restart'); }, 2000);       
       setTimeout(function() { 
       	$('#page-2').hide();}, 3000);       
       //setTimeout();
       setTimeout(function() { 
         var animatedEls = document.getElementsByClassName('AN-Object');
               for (var i = animatedEls.length - 1; i >= 0; i--) {
                 animatedEls[i].style.webkitAnimationPlayState = "paused";
               };  
             $('#page-4').removeClass("restart");
             $('#page-3').removeClass("restart");
             $('#page-2').removeClass("restart");        
         }, 3000);
     } else {
       if ($('#ann-outer-wraper').data('status') === 'opening' || $('#ann-outer-wraper').data('status') === 'closing') {
         return false;
       }
       $('.contactus, .invisible-fold').hide();
       $('#ann-outer-wraper').data('status','closing');
       $page4.show().animate({
           left: '0'
       }, 1000, 'easeInOutExpo');
       $page3.delay(1000).show().animate({
           left: '0'
       }, 1000, 'easeInOutExpo');
       $page2.delay(2000).show().animate({
           left: '0',
       }, 1000, 'easeInOutExpo', function() {
         $('#ann-outer-wraper').data('status','closed');
       });
       $page2.fadeOut('fast');
     }
   });   
 });
 function play() {
   var $page1 = $('#page-1');
   var $page2 = $('#page-2');
   var $page3 = $('#page-3');
   var $page4 = $('#page-4');
   var isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
   var chromeVersion = parseInt(navigator.userAgent.substr(navigator.userAgent.lastIndexOf('Chrome/') + 7, 10));
   $('#ann-wrapper div').css('display', 'block');
   if (Modernizr.csstransforms3d || (isChrome && chromeVersion >= 11)) {
     var animatedEls = document.getElementsByClassName('AN-Object');
     for (var i = animatedEls.length - 1; i >= 0; i--) {
       animatedEls[i].style.webkitAnimationPlayState = "running";
     }
   } else {
     if ($('#ann-outer-wraper').data('status') === 'opening' || $('#ann-outer-wraper').data('status') === 'closing') {
       return false;
     }
     $('#ann-outer-wraper').data('status','opening');
     var pageWidth = $page1.width() + 10;
     $page2.find('.page-content:eq(0)').css({
       'zIndex':'4'
     });
     $page3.css('zIndex','3');
     $page3.find('.page-content:eq(0)').css({
       'zIndex':'2'
     });
     $page4.css('zIndex','1');
     $page2.show().animate({
         left: pageWidth - 10 + 'px'
     }, 1000, 'easeInOutExpo');
     $page3.delay(1000).show().animate({
         left: pageWidth + 'px'
     }, 1000, 'easeInOutExpo');
     $page4.delay(2000).show().animate({
         left: pageWidth + 'px'
     }, 1000, 'easeInOutExpo', function() {
       $('#ann-outer-wraper').data('status','opened');
     });
   }
 }