function findid() {
  var u_license = $('#u_license').val()
  //alert(u_license)
  u_license = u_license * 1
  $.ajax({
    url: "../script/findid.php",
    data: {
      license: u_license,
    },
    type: "POST",
    dataType: "json",
  }).done(function (json) {
    setemail(json);
  })
}

function setemail(json) {
  var div = $('#u_email_col')
  var html = ''
  html += json['email']
  div.html(html)

}


function openPost() {
  $('#search_post_box').removeClass('display_none');
  new daum.Postcode({
    oncomplete: function (data) {
      $('#post_area').val(data.zonecode);
      $('#address_area').val(data.address);
    }
  }).embed(window.document.getElementById('search_post'), {
    autoClose: true
  });
}

function closePost() {
  $('#search_post_box').addClass('display_none');
}

function settingBirth() {
  var year = $('.year_area');
  var month = $('.month_area');
  var day = $('.day_area');
  var today = new Date();
  var thisYear = today.getFullYear();

  if (year.length > 0) {
    var html = ''
    for (var i = 0; i < 100; i++) {
      html += '<option value="' + (thisYear - i) + '">' + (thisYear - i) + '</option>'
    }
    year.append(html);
    html = ''
    for (var i = 1; i < 13; i++) {
      html += '<option value="' + i + '">' + i + '</option>'
    }
    month.append(html);
    html = ''
    for (var i = 1; i < 31; i++) {
      html += '<option value="' + i + '">' + i + '</option>'
    }
    day.append(html)
  }
}

function selectSignupType(type) {
  if (type === 'doctor') {
    $('#signup_form_01').find('.row').removeClass('display_none');
    $('#signup_form_02').find('.row').addClass('display_none');
  } else {
    $('#signup_form_01').find('.row').addClass('display_none');
    $('#signup_form_02').find('.row').removeClass('display_none');
  }
}

var selectedArea = [];
var searchServiceAreaTimer = null

function searchServiceArea(e) {
  // 처음엔 모든 가능 지역을 띄우도록
  if (!e) {
    $('#signup_service_area').html('');
    /*$.ajax({
        url: "/keywords.php",
        async: false,
        data: {
            keyword: "",
        },
        type: "POST",
        dataType: "json"
    })
    .done(function(json) {
        console.log(json);
        setServiceArea(json);
    })
    .fail(function(xhr, status, errorThrown) {
        console.log(errorThrown);
        console.log(status);
      });
      */
  } else {
    var searchText = e.value.trim()
    clearTimeout(searchServiceAreaTimer)
    searchServiceAreaTimer = setTimeout(function () {
      if (searchText !== '') {
        $.ajax({
            url: "../script/keywords.php",
            async: false,
            data: {
              keyword: searchText,
            },
            type: "POST",
            dataType: "json"
          })
          .done(function (json) {
            setServiceArea(json);
          })
          .fail(function (xhr, status, errorThrown) {
            console.log(errorThrown);
            console.log(status);
          });
      }
    }, 300)
  }
}

function setServiceArea(areas) {
  var html = '';
  $.each(areas, function (idx, area) {
    html += '<div class="margin_v_ss hover_g" onclick="selectAPlace(' + area["sidos_id"] + ', \'' + area["juso"] + '\')">' + area["juso"] + '</div>';
  });
  var searchArea = $('#signup_service_area');
  searchArea.html(html);
  searchArea.removeClass('display_none');
}

function selectAPlace(id, name) {
  var chipArea = $('#signup_search_chip_area')
  var searchArea = $('#signup_service_area');
  var html = ''
  html += '<div class="chip back_g_d color_w padding_s border_radius_l display_inline_block margin_right_ss margin_bottom_ss">';
  html += '  ' + name + '';
  html += '  <svg onclick="removeAPlace(' + id + ', this)" class="fill_w" style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';
  html += '</div>';
  selectedArea.push(id);
  searchArea.addClass('display_none');
  chipArea.append(html);
}

function removeAPlace(id, obj) {
  var finded = selectedArea.indexOf(id)
  selectedArea.splice(finded, 1)
  $(obj).closest('.chip').remove()

}

function setarr() {
  $('input#u_able').val(selectedArea);
}