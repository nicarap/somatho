/* Template: Pavo Mobile App Website Tailwind CSS HTML Template
   Description: Custom JS file
*/
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

(function($) {
    "use strict"; 
	
    /* Navbar Scripts */
    // jQuery to collapse the navbar on scroll
    $(window).on('scroll load', function() {
		if ($(".navbar-fixed").offset().top > 60) {
			// $(".fixed-top").addClass("top-nav-collapse");
			$(".navbar-fixed").attr("aria-disabled", "false");
		} else {
			// $(".fixed-top").removeClass("top-nav-collapse");
			$(".navbar-fixed").attr("aria-disabled", "true");
		}
    });
    
	// jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {
		$(document).on('click', 'a.page-scroll', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 600, 'easeInOutExpo');
			event.preventDefault();
		});
    });

    // close menu on click in small viewport
    $('[data-toggle="offcanvas"]').on('click', function () {
        $('.offcanvas-collapse').toggleClass('open')
    })

	var amountScrolled = 700;
    $(window).scroll(function() {
        if ($(window).scrollTop() > amountScrolled) {
            $('.back-to-top').fadeIn('500');
        } else {
            $('.back-to-top').fadeOut('500');
        }
    });

	/* Removes Long Focus On Buttons */
	$(".button, a, button").mouseup(function() {
		$(this).blur();
	});

	/* Function to get the navigation links for smooth page scroll */
	function getMenuItems() {
		var menuItems = [];
		$('.nav-link').each(function() {
			var hash = $(this).attr('href').substr(1);
			if(hash !== "")
				menuItems.push(hash);
		})
		return menuItems;
	}	

	/* Prevents adding of # at the end of URL on click of non-pagescroll links */
	$('.nav-link').click(function (e) {
		var hash = $(this).attr('href').substr(1);
		if(hash == "")
			e.preventDefault();
	});

	/* Checks page scroll offset and changes active link on page load */
	changeActive();

	/* Change active link on scroll */
	$(document).scroll(function(){
		changeActive();
	});
	
	/* Function to change the active link */
	function changeActive() {
		const menuItems = getMenuItems();
		$('.offcanvas-collapse').removeClass('open')

		$.each(menuItems, function(index, value){
			var offsetSection = $('#' + value).offset().top;
			var docScroll = $(document).scrollTop();
			var docScroll1 = docScroll + 1; 
			
			if ( docScroll1 >= offsetSection ){
				$('.nav-link').removeClass('bg-light-gold');
				$('.nav-link').removeClass('text-white');
				$('.nav-link[href$="#'+value+'"]').addClass('bg-light-gold');
				$('.nav-link[href$="#'+value+'"]').addClass('text-white', true);
			}  
		});
	}

	function animateFrom(elem, direction) {
		direction = direction || 1;
		var x = 0,
			y = direction * 100;
		if(elem.classList.contains("gs_reveal_fromLeft")) {
		  x = -100;
		  y = 0;
		} else if (elem.classList.contains("gs_reveal_fromRight")) {
		  x = 100;
		  y = 0;
		}
		
		elem.style.transform = "translate(" + x + "px, " + y + "px)";
		elem.style.opacity = "0";
		gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
		  duration: 1.25, 
		  x: 0,
		  y: 0, 
		  autoAlpha: 1, 
		  ease: "expo", 
		  overwrite: "auto"
		});
	  }
	  
	  function hide(elem) {
		gsap.set(elem, {autoAlpha: 0});
	  }
	  

	  document.addEventListener("DOMContentLoaded", function() {
		
		gsap.registerPlugin(ScrollTrigger);

		ScrollTrigger.config({ limitCallbacks: true });
		
		gsap.utils.toArray(".gs_reveal").forEach(function(elem) {
		  hide(elem); // assure that the element is hidden when scrolled into view
		  
		  ScrollTrigger.create({
			trigger: elem,
			once: true,
			start: "top 80%",
			onEnter: function() { animateFrom(elem) }, 
		  });
		});
		
	  });

	  
	  

})(jQuery);

