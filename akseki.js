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
    
	// Same-page anchor scrolling is native now: see scroll-behavior and
	// scroll-padding-top in assets/css/apt-design.css.
	
});