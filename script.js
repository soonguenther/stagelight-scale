$('*[data-type="parallax"]').each(function(){

        var $bgobj = $(this);

        $(window).scroll(function() {

            var yPos = -($window.scrollTop() / $bgobj.data('speed'));
            var coords = '50% '+ yPos + 'px';

            $bgobj.css({ backgroundPosition: coords });

        });
    });$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
(jQuery);