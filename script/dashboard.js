var search = {
  searchList: [],
  searchResult: [],
  searchArea1: function () {
    $.ajax({
      url: 'https://s3.ap-northeast-2.amazonaws.com/teajoon.work/sample_search.json',
      success:function(data){
        var searchArea = $('.search_area_00');
        var html = '';
        html += '<div class="box_shadow">';
        html += '<div class="container">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div class="row justify-content-between padding_v_m">';
        html += '        <div class="col-8 font_weight_b">시·도·광역시</div>';
        html += '        <div class="col-2" onclick="hoverSearch(\'area_01\', this)">';
        html += '          <svg xmlns="http://www.w3.org/2000/svg" style="fill: #888;" width="24" height="24" viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';
        html += '        </div>';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '<div class="container back_g_l">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div id="area_01" class="row padding_v_m">';
        $.each(data.area_1, function(index, item){
          html += '       <div class="col-4 cursor_pointer" onclick="search.searchArea2(\'' + item.id + '\', \'' + item.name + '\', this)">·' + item.name + '</div>'
        });
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '</div>';
        searchArea.html(html);
        $('#background_layer_02').removeClass('display_none')
      }
    })
  },
  searchArea2: function (id, name, obj) {
    $(obj).siblings().removeClass('color_b');
    $(obj).addClass('color_b');
    search.searchResult[0] = name;
    $.ajax({
      url: 'https://s3.ap-northeast-2.amazonaws.com/teajoon.work/sample_search.json',
      success: function(data){
        var searchArea01 = $('.search_area_01')
        var html = ''
        html += '<div class="line" style="border-color: #b5b5b5;"></div>';
        html += '<div class="box_shadow">';
        html += '<div class="container">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div class="row justify-content-between padding_v_m">';
        html += '        <div class="col-8 font_weight_b">' + data.area_2.next_step + '</div>';
        html += '        <div class="col-2" onclick="hoverSearch(\'area_02\', this)">';
        html += '          <svg xmlns="http://www.w3.org/2000/svg" style="fill: #888;" width="24" height="24" viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';
        html += '        </div>';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '<div class="container back_g_l">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div id="area_02" class="row padding_v_m">';
        $.each(data.area_2.list, function(index, item){
          html += '         <div class="col-4 cursor_pointer" onclick="search.searchArea3(\'' + item.id + '\', \'' + item.name + '\', this)">·' + item.name + '</div>';
        });
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '</div>';
        searchArea01.html(html);
        $('.search_area_02').html('');
      }
    })
  },
  searchArea3: function (id, name, obj) {
    $(obj).siblings().removeClass('color_b');
    $(obj).addClass('color_b');
    search.searchResult[1] = name
    $.ajax({
      url: 'https://s3.ap-northeast-2.amazonaws.com/teajoon.work/sample_search.json',
      success: function(data){
        var searchArea02 = $('.search_area_02');
        var html = ''
        html += '<div class="line" style="border-color: #b5b5b5;"></div>';
        html += '<div class="box_shadow">';
        html += '<div class="container">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div class="row justify-content-between padding_v_m">';
        html += '        <div class="col-8 font_weight_b">' + data.area_3.next_step + '</div>';
        html += '        <div class="col-2" onclick="hoverSearch(\'area_03\', this)">';
        html += '          <svg xmlns="http://www.w3.org/2000/svg" style="fill: #888;" width="24" height="24" viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';
        html += '        </div>';
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '<div class="container back_g_l">';
        html += '  <div class="row">';
        html += '    <div class="col-12">';
        html += '      <div id="area_03" class="row padding_v_m">';
        $.each(data.area_3.list, function(index, item){
          html += '         <div class="col-4 cursor_pointer" onclick="selectPlace(\'' + item.id + '\', \'' + item.name + '\')">·' + item.name + '</div>';
        });
        html += '      </div>';
        html += '    </div>';
        html += '  </div>';
        html += '</div>';
        html += '</div>';
        search.searchList = data.area_3.list
        searchArea02.html(html);
      }
    })
  },
  search: function () {

    var type = $('#doctor_type_val');
    var typeName = $('.doctor_type_name');
    var place = $('#search_place_val');
    var placeName = $('.search_place_name');

    if (!type.val().trim()) return alert('진료과목을 선택해주세요.');
    if (!place.val().trim()) return alert('장소를 검색해주세요.');

    var data = $('#system_search_form').serialize();

    /////////////////////
    //// api 조회 후!! ////
    /////////////////////

    var item = {
      lat: 37.576127, lng: 126.903377, // 이외의 각종 정보
    }

    search.setNav(item);
    $('.system_search_area').addClass('display_none');
    $('.system_result_area').removeClass('display_none');
    $('.search_place_name').val(typeName.val() + ' / ' + placeName.val());
    $('.background_layer').addClass('display_none');
    $('.download_btn').removeClass('display_none');

    mapClass.clearPickers();
    mapClass.setCenter(item.lat, item.lng, 15);
    mapClass.setPicker(item.lat, item.lng);
  },
  setNav: function (item) {
    var html = '';
    html += '<div class="tab_0 tab_area">';
    html += '  <div class="container back_w padding_m box_shadow">';
    html += '    <div class="row">';
    html += '      <div class="col-12 font_weight_b font_size_l">서울특별시 강남구 역삼1동</div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">강남구</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">의사 1인당 환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">생활인구 밀도</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12">';
    html += '        <div class="line margin_v_s"></div>';
    html += '      </div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">역삼1동</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 생활인구수</div><div class="display_inline_block">28,877명</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 환자유입력</div><div class="display_inline_block">10.0점 / 10</div>';
    html += '      </div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s margin_bottom_xl">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '</div>';
    html += '<div class="display_none tab_1 tab_area">';
    html += '  <div class="container back_w padding_m box_shadow">';
    html += '    <div class="row">';
    html += '      <div class="col-12 font_weight_b font_size_l">서울특별시 강남구 역삼2동</div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">강남구</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">의사 1인당 환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">생활인구 밀도</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12">';
    html += '        <div class="line margin_v_s"></div>';
    html += '      </div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">역삼1동</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 생활인구수</div><div class="display_inline_block">28,877명</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 환자유입력</div><div class="display_inline_block">10.0점 / 10</div>';
    html += '      </div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s margin_bottom_xl">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '</div>';
    html += '<div class="tab_2 display_none tab_area">';
    html += '  <div class="container back_w padding_m box_shadow">';
    html += '    <div class="row">';
    html += '      <div class="col-12 font_weight_b font_size_l">서울특별시 강남구 역삼3동</div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">강남구</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">의사 1인당 환자수</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">생활인구 밀도</div><div class="display_inline_block">다소 적음</div>';
    html += '      </div>';
    html += '      <div class="col-12">';
    html += '        <div class="line margin_v_s"></div>';
    html += '      </div>';
    html += '      <div class="col-12 font_weight_b margin_top_s"><span class="color_b">역삼1동</span> 정보</div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 생활인구수</div><div class="display_inline_block">28,877명</div>';
    html += '      </div>';
    html += '      <div class="col-12 margin_top_ss">';
    html += '        <div class="tag2">남자 30대 환자유입력</div><div class="display_inline_block">10.0점 / 10</div>';
    html += '      </div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="container back_w padding_m margin_top_s margin_bottom_xl">';
    html += '    <div class="row">';
    html += '      <div class="col-12"><span class="color_b">역삼 1동</span>의 남자 30대 하루 생활인구 수 변화</div>';
    html += '      <div class="col-12 margin_top_s"><div class="box"></div></div>';
    html += '    </div>';
    html += '  </div>';
    html += '</div>';
    $('.nav_desc_area').append(html);
    $('.nav_tab_area').removeClass('display_none');
    $('.nav_explain_area').addClass('display_none');
    $('.download_btn').removeClass('display_none');
  }
}

function hoverMobileDesc () {
  var explain = $('#mobile_desc_area');
  if (explain.hasClass('hide')) {
    explain.removeClass('hide')
  } else {
    explain.addClass('hide')
  }
}

function clearSearch () {
  mapClass.clearPickers();
  clearSearchArea();

  var type = $('#doctor_type_val');
  var typeName = $('.doctor_type_name');
  var place = $('#search_place_val');
  var placeName = $('.search_place_name');

  $('.system_search_area').removeClass('display_none');
  $('.system_result_area').addClass('display_none');
  placeName.val('');
  typeName.val('');
  type.val('');
  place.val('');

  $('.nav_desc_area').html('');
  $('.nav_tab_area').addClass('display_none');
  $('.nav_explain_area').removeClass('display_none');
  $('.download_btn').addClass('display_none');
}

function clearSearchArea () {
  $('.doctor_type_list').addClass('display_none');
  $('.search_area').addClass('display_none');
  $('#nav_small_02_background_layer').addClass('display_none');
  var doctorType = $('.doctor_type');
  var searchPlace = $('.search_place');
  doctorType.each(function (index, item) {
    $(item).find('.svg_area').children('svg').eq(0).removeClass('display_none');
    $(item).find('.svg_area').children('svg').eq(1).addClass('display_none');
  });
  searchPlace.each(function (index, item) {
    $(item).find('.svg_area').children('svg').eq(0).removeClass('display_none');
    $(item).find('.svg_area').children('svg').eq(1).addClass('display_none');
  })
}

function selectResultType (number, type) {
  var systemResultSelectArea = $('.system_result_select_area');
  systemResultSelectArea.find('.select_result').html(type);
  hoverSelectResultType();
  var navDescArea = $('.nav_desc_area');
  navDescArea.find('.tab_area').addClass('display_none');
  navDescArea.find('.tab_' + number).removeClass('display_none');
}

function hoverSelectResultType () {
  var selectList = $('.system_result_select_area').find('.select_list');
  if (selectList.hasClass('display_none')) selectList.removeClass('display_none')
  else selectList.addClass('display_none');
}

function hoverSearchArea () {
  var searchPlace = $('.search_place');
  var searchArea = searchPlace.find('.search_area');
  if (searchArea.hasClass('display_none')) {
    search.searchResult = [];
    searchPlace.find('.search_place_val').val('');
    searchPlace.find('.search_place_name').val('');
    $('.search_area_01').html('');
    $('.search_area_02').html('');
    searchArea.removeClass('display_none');
    search.searchArea1();
    searchPlace.each(function (index, item) {
      $(item).find('.svg_area').children('svg').eq(0).addClass('display_none');
      $(item).find('.svg_area').children('svg').eq(1).removeClass('display_none');
    })
    $('#nav_small_02_background_layer').removeClass('display_none');
  } else {
    searchArea.addClass('display_none');
  }
}

function selectPlace (value, name) {
  search.searchResult[2] = name
  var searchPlace = $('.search_place');
  $('#search_place_val').val(value)
  searchPlace.find('.search_place_name').val(search.searchResult.join(' '));
  searchPlace.find('.search_area_01').html('');
  searchPlace.find('.search_area_02').html('');
  searchPlace.find('.search_area').addClass('display_none');
  searchPlace.find('.svg_area').children('svg').eq(1).addClass('display_none');
  searchPlace.find('.svg_area').children('svg').eq(0).removeClass('display_none');
  $('#nav_small_02_background_layer').addClass('display_none');
}

function hoverSearchDoctorType () {
  var doctorType = $('.doctor_type');
  var doctorTypeList = doctorType.find('.doctor_type_list');
  var navBack = $('#nav_small_02_back');
  if (doctorTypeList.hasClass('display_none')) {
    doctorTypeList.removeClass('display_none');
    doctorType.each(function (index, doctor) {
      var svgs = $(doctor).find('.svg_area').children('svg');
      svgs.eq(0).addClass('display_none');
      svgs.eq(1).removeClass('display_none');
    })
    navBack.removeClass('display_none');
    $('#nav_small_02_background_layer').removeClass('display_none');
  } else {
    doctorTypeList.addClass('display_none');
    var svgs = doctorType.find('.svg_area').children('svg');
    svgs.eq(0).removeClass('display_none');
    svgs.eq(1).addClass('display_none');
    navBack.addClass('display_none');
    $('#nav_small_02_background_layer').addClass('display_none');
  }
}

function setDoctorType () {
  var types = [
    {name: '피부과', value: '0'},
    {name: '성형외과', value: '1'},
    {name: '이비인후과', value: '2'},
    {name: '내과', value: '3'},
    {name: '소아청소년과', value: '4'},
    {name: '정형외과', value: '0'},
    {name: '안과', value: '0'},
    {name: '치과', value: '0'},
    {name: '한의원', value: '0'},
    {name: '산부인과', value: '0'},
    {name: '비뇨기과', value: '0'},
    {name: '정신건강의학과', value: '0'},
    {name: '가정의학과', value: '0'},
    {name: '외과', value: '0'},
    {name: '신경외과', value: '0'},
    {name: '마취통증의학과', value: '0'},
    {name: '신경과', value: '0'}
  ]
  var html = '';
  $.each(types, function (index, type) {
    html += '<li onclick="selectDoctorType(' + type.value + ', \'' + type.name + '\', this)">' + type.name + '</li>'
  })
  $('.doctor_type_list').html(html);
}

function selectDoctorType (value, name, obj) {
  var inputArea = $(obj).closest('.doctor_type');
  $('.doctor_type_name').val(name);
  $('#doctor_type_val').val(value)
  inputArea.find('.doctor_type_list').addClass('display_none');
  inputArea.find('.svg_area').children('svg').eq(1).addClass('display_none')
  inputArea.find('.svg_area').children('svg').eq(0).removeClass('display_none')
  $('#nav_small_02_background_layer').addClass('display_none')
}

$(document).ready(function(){
  var lat = -25.344
  var lng = 131.036

  mapClass.initMap(lat, lng, 'map');
  setDoctorType();
});