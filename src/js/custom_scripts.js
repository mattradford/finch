// GLOBAL SCRIPTS

jQuery(document).ready(function ($) {


  $(".home .page-slideshow__inner .button-green").on("click", function (e) {
    e.preventDefault();
    $("body, html").animate({
      scrollTop: $($(this).attr('href')).offset().top
    }, 600);
  });

  $(".banner .nav-control").on("click", function (e) {
    e.preventDefault();
    $(".nav-control").toggleClass("active");
    $(".navbar--header").toggleClass("active");
  });

  // $(".page-slideshow__slick").slick();

  // $('.page-gallery').magnificPopup({
  //   delegate: 'a',
  //   type: 'image',
  //   gallery: {
  //     enabled: true
  //   }
  // });
 
});


(function ($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Roots = {
    // All pages
    common: {
      init: function () {
        // JavaScript to be fired on all pages
      }
    },
    // Home page
    home: {
      init: function () {
        // JavaScript to be fired on the home page
        $('.fp__callout').attr('id', 'find-out-more');
      }
    },
    // About us page, note the change from about-us to about_us.
    joining: {
      init: function () {
        // JavaScript to be fired on the Joining page
         
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
      var namespace = Roots;
      funcname = (funcname === undefined) ? 'init' : funcname;
      if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function () {
      UTIL.fire('common');

      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
        UTIL.fire(classnm);
      });
    }
  };

  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.