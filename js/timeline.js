$(function(){

  window.sr = ScrollReveal();
  //
  // if ($(window).width() < 768) {
  //
  // 	if ($('.timeline-content').hasClass('js--fadeInLeft')) {
  // 		$('.timeline-content').removeClass('js--fadeInLeft').addClass('js--fadeInRight');
  // 	}
  //
  //   if ($('.container').hasClass('js--fadeInLeft') || $('.container').hasClass('js--fadeInBottom')) {
  // 		$('.container').removeClass('js--fadeInLeft').addClass('js--fadeInRight');
  //     $('.container').removeClass('js--fadeInBottom').addClass('js--fadeInRight');
  // 	}
  //
  // 	sr.reveal('.js--fadeInRight', {
	//     origin: 'right',
	//     distance: '300px',
	//     easing: 'ease-in-out',
	//     duration: 800,
	//   });
  //
  // } else {
  //
  // 	sr.reveal('.js--fadeInLeft', {
	//     origin: 'left',
	//     distance: '300px',
	// 	  easing: 'ease-in-out',
	//     duration: 800,
	//   });
  //
	//   sr.reveal('.js--fadeInRight', {
	//     origin: 'right',
	//     distance: '300px',
	//     easing: 'ease-in-out',
	//     duration: 800,
	//   });
  //
  // }

  if ($(window).width() < 768) {

  	  sr.reveal('.js--fadeInRight, .js--fadeInLeft, .js--fadeInBottom', {
  	    origin: 'right',
  	    distance: '300px',
  	    easing: 'ease-in-out',
  	    duration: 1000,
  	  });

      sr.reveal('.js--fadeInTop', {
    	    origin: 'top',
    	    distance: '300px',
    		  easing: 'ease-in-out',
    	    duration: 1000,
    	  });

        sr.reveal('.js--fadeInside', {
      	    origin: 'left',
            scale: 0.1,
      	    distance: '300px',
      		  easing: 'ease-in-out',
      	    duration: 1000,
      	  });
  }

  else {
    sr.reveal('.js--fadeInLeft', {
  	    origin: 'left',
  	    distance: '300px',
  		  easing: 'ease-in-out',
  	    duration: 1000,
  	  });

  	  sr.reveal('.js--fadeInRight', {
  	    origin: 'right',
  	    distance: '300px',
  	    easing: 'ease-in-out',
  	    duration: 1000,
  	  });

      sr.reveal('.js--fadeInBottom', {
    	    origin: 'bottom',
    	    distance: '300px',
    		  easing: 'ease-in-out',
    	    duration: 1000,
    	  });

      sr.reveal('.js--fadeInTop', {
    	    origin: 'top',
    	    distance: '300px',
    		  easing: 'ease-in-out',
    	    duration: 1000,
    	  });

        sr.reveal('.js--fadeInside', {
      	    origin: 'left',
            scale: 0.1,
      	    distance: '300px',
      		  easing: 'ease-in-out',
      	    duration: 1000,
      	  });
  }


});
