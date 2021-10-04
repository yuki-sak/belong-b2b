/*
sp-menu
==================================================*/
$(window).on('load', function () {
  $('.jsMenuTrig').on('click', function () {
    if (!$(this).hasClass('_open')) {
      scrollpos = $(window).scrollTop();
    }
    $(this).toggleClass('_open');
    $('.jsMenu').toggleClass('_open');
    if ($(this).hasClass('_open')) {
      $('body,html').css({ 'overflow': 'hidden', 'height': 'auto' });
      $('body').css({ 'top': -scrollpos });
    } else {
      $('body,html').css({ 'overflow': 'initial' });
      window.scrollTo(0, scrollpos);
    }
  });
});

// 画面幅判定
function size() {
  var window_w = $(window).width();
  var breakpoint = 767;
  if (window_w < breakpoint) {
    return 'sp_content';
  } else {
    return 'pc_content';
  }
}

//スライダーSPのみ
$(function () {
  function sliderSetting() {
    if (size() == 'sp_content') {
      $('.jsSliderSp').not('.slick-initialized')
        .on('init', function (event, slick) {
          parent = $(this).closest('.jsSliderSp_parent');
          arrPrev = $(this).find('button.slick-prev');
          arrPrev.html('');
          parent.find('.jsSliderSpCt__prevArr').prepend(arrPrev);
          arrNext = $(this).find('button.slick-next');
          arrNext.html('');
          parent.find('.jsSliderSpCt__nextArr').prepend(arrNext);
        })
        .slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          //arrows: false,
          variableWidth: true,
          dots: false,
          //centerMode: true,
        });
    } else {
      $('.jsSliderSp.slick-initialized').slick('unslick');
    }
  }
  $(window).on('load resize', function () {
    sliderSetting();
  });
});

$(function () {
  targetOfsY = ($('.l-topMain').offset().top);
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > targetOfsY) {
      $('.l-header--top').addClass('_active');
    } else {
      $('.l-header--top').removeClass('_active');
    }
  });
});



$(function () {
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 60) {
      $('.js-contBuy').addClass('_active');
    } else {
      $('.js-contBuy').removeClass('_active');
    }
  });
});







AOS.init({
  once: true
});

document.addEventListener('DOMContentLoaded', function () {

  var markerText = document.querySelectorAll('.js-marker'); // 監視対象を選択
  var markerTextArr = Array.prototype.slice.call(markerText); // 監視対象をArrayに変換（IE対策）

  /* IntersectionObserverに渡すコールバック関数 */
  var cb = function (entries, observer) {
    entries.forEach((entry) => {

      if (entry.isIntersecting) {
        /* 監視対象が画面内に入ったときのアクション */
        entry.target.classList.add('inview'); // 画面内に入った要素にinviewクラスを付与
        observer.unobserve(entry.target); // 1度発火した後監視を止める
      }

    });
  }

  /* IntersectionObserverに渡すコールバック関数 */
  var options = {
    rootMargin: "-50px 0px"
  }

  /* IntersectionObserver初期化 */
  var io = new IntersectionObserver(cb, options);
  io.POLL_INTERVAL = 100; // Polyfillの設定

  markerTextArr.forEach(el => {
    io.observe(el);
  });

});