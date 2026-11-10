jQuery(function($) {
	/*add class to search modal window for bootstrap styling*/
	$("#searchModal input, #searchModal select").addClass("form-control");
	$("#searchModal input[type='submit']").addClass("btn btn-primary");
	
	/*popup image in detail post
	
	$(".popup-image").click(function() {
		preventDefault();
		alert('te');
	   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
	   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
	});*/

	$( ".popup-image" ).click(function() {
		$imgsrc = $(this).find('> img').attr('src');
		$imgsrc = ($imgsrc.replace(/-\d+?x\d+?\./,'.'));
		$('#imagepreview').attr('src', $imgsrc);
		$('#imagemodal').modal('show');
		$thetitle=$(this).find('> img').attr('alt');
		$('#image-title').html($thetitle);
	});
	
	/*sidebar in detail page*/
	function toggleIcon(e) {		
        $(this)            
            .find(".more-less")
            .toggleClass('dashicons-arrow-down dashicons-arrow-up');
    }
    $('.detail-sidebar').on('hidden.bs.collapse', toggleIcon);
    $('.detail-sidebar').on('shown.bs.collapse', toggleIcon);	
    
      //jQuery smooth scrolling on anchor in the same page
  // Select all links with hashes
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        var header = document.querySelector('.apt-header');
        var offset = header ? header.offsetHeight + 8 : 0;
        $('html, body').animate({
          scrollTop: target.offset().top - offset
        }, 700, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });	
});