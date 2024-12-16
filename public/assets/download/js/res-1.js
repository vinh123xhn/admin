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
    $('.wrapper').css({ transform: "scale(" + w / 960 + ")" });
    var iw = $(".wrapper")[0].getBoundingClientRect().width;
    var ih = $(".wrapper")[0].getBoundingClientRect().height;
    $('body').css({ height: ih, width: iw });
  }

  $(window).on('resize', function () {
    var w1 = $(window).width();
    if (w1 > 960) {
      $('.wrapper').css({ transform: "scale(" + w / 2000 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });
    }
    var h = $(window).height();
    var w = $(window).width();
    if (w > 960) {
      $('.wrapper').css({ transform: "scale(" + w / 2000 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });

    }
    else if (320 < w < 960) {
      $('.wrapper').css({ transform: "scale(" + w / 960 + ")" });
      var iw = $(".wrapper")[0].getBoundingClientRect().width;
      var ih = $(".wrapper")[0].getBoundingClientRect().height;
      $('body').css({ height: ih, width: iw });
    }
  });
});

var swiper1 = new Swiper(".mySwiper1", {
  spaceBetween: 10,
  slidesPerView: 7,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    320: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    960: {
      slidesPerView: 7,
      spaceBetween: 10,
    },
  },
});
var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2500,
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
AOS.init({
  disable: function () {
    var maxWidth = 1600;
    return window.innerWidth < maxWidth;
  }
});