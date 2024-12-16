// JavaScript Document
$(document).ready(function () {
  var h = $(window).height();
  var w = $(window).width();
  if (w > 960) {
    $('.wrapper, .header').css({ transform: "scale(" + w / 2000 + ")" });
    var iw = $(".wrapper")[0].getBoundingClientRect().width;
    var ih = $(".wrapper")[0].getBoundingClientRect().height;
    $('body').css({ height: ih, width: iw });

  }
  else if (320 < w < 960) {
    $('.wrapper, .header, .neo-bottom').css({ transform: "scale(" + w / 960 + ")" });
    var iw = $(".wrapper")[0].getBoundingClientRect().width;
    var ih = $(".wrapper")[0].getBoundingClientRect().height;
    $('body').css({ height: ih, width: iw });
  }

  $(window).on('resize', function () {
    var w1 = $(window).width();
    if (w1 > 960) {
      $('.wrapper, .header').css({ transform: "scale(" + w / 2000 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });
    }
    var h = $(window).height();
    var w = $(window).width();
    if (w > 960) {
      $('.wrapper, .header').css({ transform: "scale(" + w / 2000 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });

    }
    else if (320 < w < 960) {
      $('.wrapper, .header, .neo-bottom').css({ transform: "scale(" + w / 960 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  // You get the current window width
  var width = window.innerWidth;

  //Than you define the AOS settings for different widths
  if (width <= 1000) { // For example, this can be for mobile devices
    AOS.init({
      disable: window.innerWidth < 1000,
    });
  } else if (width > 1200 && width <= 1900) { // And you make a condition for tablets too
    AOS.init({
      offset: -1000,
      duration: 2000,
	  anchorPlacement: 'top-bottom'
    });
  } else { // Else for just, you know, desktops
    AOS.init({
	  offset: 0,
      duration: 1500
    });
  }
});

var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
		autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

var swiper1 = new Swiper(".mySwiper1", {
      spaceBetween: 10,
      slidesPerView: 7,
      freeMode: true,
      watchSlidesProgress: true,
	
    });
    var swiper2 = new Swiper(".mySwiper2", {
      spaceBetween: 10,
		loop: true,
		autoplay: {
        delay: 250000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper1,
      },
    });
