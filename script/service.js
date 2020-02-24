var thisSlide = 0;
var scrollEvent = false;

function submitEstimate() {

  // 입력하지 않았을 경우
  var inValid = [0, 2, 3] // 입력하지 않은 input들
  var estimate = $("#estimate")
  var sections = estimate.find('section');
  $.each(inValid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(inValid[0] + 1)
}

function submit1() {
  var invalid = new Array();
  var form1 = $('#form1')
  var sections = form1.find('section');
  if ($('#f1_address').val() == '') {
    invalid.push(0);
  }
  if ($('#f1_det').val() == '') {
    invalid.push(1);
  }
  if ($('#f1_budget').val() == '') {
    invalid.push(2);
  }
  if ($('#f1_concept').val() == '') {
    invalid.push(3);
  }
  if ($('#f1_date').val() == '') {
    invalid.push(4);
  }
  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 2)
  if (invalid.length == 0) return true;
  else return false;
}

function submit2() {
  var invalid = new Array();
  var form2 = $('#form2')
  var sections = form2.find('section');
  if ($('#f2_date').val() == '') {
    invalid.push(0);
  }
  if ($('#f2_money').val() == '') {
    invalid.push(1);
  }
  if ($('#f2_type').val() == '') {
    invalid.push(2);
  }
  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 8)
  if (invalid.length == 0) return true;
  else return false;
}

function submit3() {
  var invalid = new Array();
  var form3 = $('#form3')
  var sections = form3.find('section');
  if ($('#f3_concept').val() == '') {
    invalid.push(0);
  }

  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 12)
  if (invalid.length == 0) return true;
  else return false;
}

function submit4() {
  var invalid = new Array();
  var form4 = $('#form4')
  var sections = form4.find('section');
  if ($('#f4_type').val() == '') {
    invalid.push(0);
  }
  if ($('#f4_year').val() == '') {
    invalid.push(1);
  }
  if ($('#f4_date').val() == '') {
    invalid.push(2);
  }
  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 14)
  if (invalid.length == 0) return true;
  else return false;
}

function submit5() {
  var invalid = new Array();
  var form5 = $('#form5')
  var sections = form5.find('section');
  if ($('#f5_all').val() == '') {
    invalid.push(0);
  }

  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 18)
  if (invalid.length == 0) return true;
  else return false;
}

function submit6() {
  var invalid = new Array();
  var form6 = $('#form6')
  var sections = form6.find('section');
  if ($('#f6_type').val() == '') {
    invalid.push(0);
  }
  if ($('#f6_detail').val() == '') {
    invalid.push(1);
  }
  $.each(invalid, function (index, inval) {
    sections.eq(inval).find('input').addClass('is-invalid')
  })
  estimateSlideTo(invalid[0] + 20)
  if (invalid.length == 0) return true;
  else return false;
}

function estimateSlideTo(number) {
  if (number > 0 && number <= 23) {
    thisSlide = number
    $("#estimate").moveTo(thisSlide);
  }
}

$(document).ready(function () {
  $('#estimate').onepage_scroll({
    sectionContainer: "section", // sectionContainer accepts any kind of selector in case you don't want to use section
    easing: "ease", // Easing options accepts the CSS3 easing animation such "ease", "linear", "ease-in",
    animationTime: 1000, // AnimationTime let you define how long each section takes to animate
    pagination: false, // You can either show or hide the pagination. Toggle true for show, false for hide.
    updateURL: false, // Toggle this true if you want the URL to be updated automatically when the user scroll to each page.
    loop: false, // You can have the page loop back to the top/bottom when the user navigates at up/down on the first/last page.
    keyboard: true, // You can activate the keyboard controls
    responsiveFallback: false, // You can fallback to normal page scroll by defining the width of the browser in which
    direction: "vertical"
  })


  $('#form1').hide();
  $('#form2').hide();
  $('#form3').hide();
  $('#form4').hide();
  $('#form5').hide();
  $('#form6').hide();
})

function formtype(type) {
  if (type === 'form1') {
    $('#form1').show();
    $('#form2').hide();
    $('#form3').hide();
    $('#form4').hide();
    $('#form5').hide();
    $('#form6').hide();
  } else if (type === 'form2') {
    $('#form1').hide();
    $('#form2').show();
    $('#form3').hide();
    $('#form4').hide();
    $('#form5').hide();
    $('#form6').hide();
  } else if (type === 'form3') {
    $('#form1').hide();
    $('#form2').hide();
    $('#form3').show();
    $('#form4').hide();
    $('#form5').hide();
    $('#form6').hide();
  } else if (type === 'form4') {
    $('#form1').hide();
    $('#form2').hide();
    $('#form3').hide();
    $('#form4').show();
    $('#form5').hide();
    $('#form6').hide();
  } else if (type === 'form5') {
    $('#form1').hide();
    $('#form2').hide();
    $('#form3').hide();
    $('#form4').hide();
    $('#form5').show();
    $('#form6').hide();
  } else if (type === 'form6') {
    $('#form1').hide();
    $('#form2').hide();
    $('#form3').hide();
    $('#form4').hide();
    $('#form5').hide();
    $('#form6').show();
  }
}