$(document).ready(function(){
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


$(function() {
  var wow = new WOW({
    boxClass: 'wow',
    animateClass: 'is-animating'
  }).init();
})



$(document).ready(function(){
   $(window).scroll(function(){
       if ($(this).scrollTop() > 200) {
           $('.navbar').fadeIn(500);
       } else {
           $('#.navbar').fadeOut(500);
       }
   });
});


MotionUI.animateIn('.index .logo-wrapper', 'fade-in');
//MotionUI.animateIn('.services p', 'fade-in');
//MotionUI.animateIn('.about-us .btn', 'fade-in');

lightGallery(document.getElementById('lightgallery')); 
