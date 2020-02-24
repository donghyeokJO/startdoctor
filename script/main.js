function sampleDiagnose() {
  var html = '';
  html += '<div class="chart_area">';
  html += '  <div class="title font_weight_b">서울특별시 성북구 안암동</div>';
  html += '  <div class="chart row justify-content-between">';
  html += '    <div class="col-12 col-sm-4">';
  html += '      <div class="title">500m 반경 진료과목 현황 Top 5</div>';
  html += '    </div>';
  html += '    <div class="col-12 col-sm-4">';
  html += '      <div class="title">일별 생활인구 비율</div>';
  html += '    </div>';
  html += '    <div class="col-12 col-sm-3">';
  html += '      <div class="title">소비력 지수</div>';
  html += '      <div class="total"><span>5.5점</span>/10</div>';
  html += '    </div>';
  html += '  </div>';
  html += '</div>';
  $('#sample_diagnose').html(html);
}



$(document).ready(function () {
  var screenHeight = screen.height
  var offsetTops = []
  const slideUp = window.document.getElementsByClassName('slideUp')


  // Kakao.init('a1267079d7c89af94cb8d9e79a8ed946');
  // Kakao.Channel.createAddChannelButton({
  //   container: '#kakao-add-channel-button',
  //   channelPublicId: '_xeIrFj'
  // });
  // Kakao.Channel.createChatButton({
  //   container: '#kakao-talk-channel-chat-button',
  //   channelPublicId: '_xeIrFj'
  // });

  $("#slider").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000,
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 4
      }
    }
  });
  $("#slider2").owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    animateOut: 'fadeOut',
    responsive: {
      0: {
        items: 1
      }
    }
  });
  $("#slider3").owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    autoplay: true,
    animateOut: 'fadeOut',
    autoplayTimeout: 2000,
    responsive: {
      0: {
        items: 1
      }
    }
  });

  for (var i = 0; i < slideUp.length; i++) {
    offsetTops.push(slideUp[i].offsetTop - screenHeight + 70)
  }

  window.document.body.addEventListener('scroll', function () {
    for (var i = 0; i < offsetTops.length; i++) {
      if (window.document.body.scrollTop >= offsetTops[i]) {
        var classes = slideUp[i].getAttribute('class')
        if (classes.indexOf('up') === -1) {
          slideUp[i].setAttribute('class', classes + ' up')
        }
      }
    }
  })

  var lat = -25.344
  var lng = 131.036

  // mapClass.initMap(lat, lng, 'map', function () {
  //   mapClass.setPicker(lat, lng, sampleDiagnose)
  // })
});