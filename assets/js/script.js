


$(document).ready(function() {
	$(window).scroll(function() {
		       if($(this).scrollTop() > 100) { 
		            $('.navbar').addClass('scrolled');
		        } else {
		            $('.navbar').removeClass('scrolled');
		        }
		 });


		window.onload = function(){ 

		 	const loaderContainer = document.getElementById('loaderContainer');
			loaderContainer.setAttribute('class', 'd-none');

		}


});


		