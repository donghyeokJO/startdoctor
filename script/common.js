function hoverNavigation() {
  var categorySmall = window.document.getElementById('nav_small');
  if (categorySmall.getAttribute('class') === 'open') {
    categorySmall.setAttribute('class', '')
    $('#background_layer_01').addClass('display_none');
  } else {
    categorySmall.setAttribute('class', 'open');
    $('#background_layer_01').removeClass('display_none');
  }
}

function hoverMemberDesc(display) {
  var memberDesc = $('#member_desc');
  if (memberDesc.hasClass('display_none')) {
    if (display === undefined || display === true) {
      memberDesc.removeClass('display_none');
      hoverAlarm(false)
    }
  } else {
    memberDesc.addClass('display_none');
  }
}



function hoverAlarm(display) {
  var popAlarm = $('#pop_alarm');
  if (popAlarm.hasClass('display_none')) {
    if (display === undefined || display === true) {
      popAlarm.removeClass('display_none')
      hoverMemberDesc(false)
    }
  } else {
    popAlarm.addClass('display_none')
  }
}

function positionToTop() {
  $('html, body').animate({
    scrollTop: '0'
  }, 1000);
}

function modal(title, html, callback, confirmText) {
  $('#modal_title').html(title);
  $('#modal_body').html(html);
  var modal = $('#modal');
  var modalSave = $('#modal_save');
  modalSave.html(confirmText ? confirmText : '저장하기');
  modalSave.unbind();

  function call() {
    if (callback) callback()
    modal.modal('hide');
  }
  modalSave.click(call);
  modal.modal();
}

function setRadioColor(obj) {
  var self = $(obj);
  self.closest('.form-area').find('.form-check').addClass('unchecked');
  self.closest('.form-check').removeClass('unchecked');
}

function pagination(element, total, listPerPage, noPerPage, pageNo, callback) {
  var html = '';
  if (pageNo !== 1) html += '<li class="page-item margin_left_ss font_size_m" onclick="' + callback + '(' + (pageNo - 1) + ')"><svg xmlns="http://www.w3.org/2000/svg" style="width: 18px;" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></li>';
  var half = Math.floor(noPerPage / 2);
  for (var i = half; i > 0; i--) {
    if (pageNo - i > 0) {
      html += '<li class="page-item margin_left_ss font_size_m cursor_pointer" onclick="' + callback + '(' + (pageNo - i) + ')">' + (pageNo - i) + '</li>';
    }
  }
  html += '<li class="page-item margin_left_ss font_size_m color_b">' + pageNo + '</li>';
  for (var i = 1; i <= half; i++) {
    if (pageNo + i <= Math.ceil(total / listPerPage)) {
      html += '<li class="page-item margin_left_ss font_size_m cursor_pointer" onclick="' + callback + '(' + (pageNo + i) + ')">' + (pageNo + i) + '</li>';
    }
  }
  if (pageNo !== Math.ceil(total / listPerPage)) html += '<li class="page-item margin_left_ss font_size_m cursor_pointer" onclick="' + callback + '(' + (pageNo + 1) + ')"><svg xmlns="http://www.w3.org/2000/svg" style="width: 18px;" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></li>';
  element.html(html)
}

function timeFormat(timestamp, format) {
  moment.locale('ko');
  return (format === 'calendar') ? moment(timestamp).calendar() : moment(timestamp).format(format)
}

function scrollToId(id) {
  console.log($("#" + id).offset().top)
  $('html, body').animate({
    scrollTop: $("#" + id).offset().top
  }, 1000);
}