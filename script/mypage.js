function saveEmail() {
  var newEmail = $("#new_email").val()
}

function modalEmail() {
  var html = ""
  html += '<form method="POST" action = "change_email.php">'
  html += '<div class="container">'
  html += '  <div class="row">'
  html += '    <div class="col-12">'
  html += "     이메일"
  html += "    </div>"
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += '      <input id="new_email" type="text" name="new_email" placeholder="이메일" />'
  html += "    </div>"
  html += "  </div>"

  html += '   <div class="row">'
  html += '     <div class="col-12 margin_top_s" >'
  html += '         <input type="submit" name ="insert" id="insert" value="저장하기" class="btn btn-primary" style ="float:right" />'
  html += '     </div>'
  html += '   </div>'
  html += "</div>"
  html += "</form>"
  modal("정보수정하기", html, saveEmail)
}

function modalPW() {
  var html = ""
  html += '<form method="POST" action = "change_pw.php">'
  html += '<div class="container">'
  html += '  <div class="row">'
  html += '    <div class="col-12">'
  html += "     현재비밀번호"
  html += "    </div>"
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += '      <input id="new_email" type="password" name="cur_pw" placeholder="현재 비밀번호" />'
  html += "    </div>"
  html += "  </div>"
  html += '  <div class="row">'
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += "     변경할 비밀번호"
  html += "    </div>"
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += '      <input id="new_email" type="password" name="new_pw" placeholder="새로운 비밀번호" />'
  html += "    </div>"
  html += "  </div>"
  html += '  <div class="row">'
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += "     변경할 비밀번호"
  html += "    </div>"
  html += '    <div class="col-12 margin_top_s position_relative">'
  html += '      <input id="new_email" type="password" name="new_pwc" placeholder="새로운 비밀번호 확인" />'
  html += "    </div>"
  html += "  </div>"

  html += '   <div class="row">'
  html += '     <div class="col-12 margin_top_s" >'
  html += '         <input type="submit" name ="insert" id="insert" value="저장하기" class="btn btn-primary" style ="float:right" />'
  html += '     </div>'
  html += '   </div>'
  html += "</div>"
  html += "</form>"
  modal("정보수정하기", html, saveEmail)
}

function savePhone() {
  var frm = $("#new_phone_frm")
  // var phone = frm.find('input[name=]');
  // var authNumber = frm.find('input[name=]');
}

function modalPhone() {
  var html = ""
  html += '<form method="POST" action = "change_phone.php">'
  html += '<div class="container">'
  html += '  <form id="new_phone_frm">'
  html += '     <div class="row">'
  html += '       <div class="col-12">'
  html += "        연락처"
  html += "       </div>"
  html += '       <div class="col-12 margin_top_s position_relative">'
  html += '          <input type="text" name="new_phone" placeholder="연락처" />'
  html +=
    '          <div class="button10 position_absolute" style="right: 25px; top: 15px">인증번호 보내기</div>'
  html += "       </div>"
  html += '       <div class="col-12 margin_top_l">'
  html += "        인증번호"
  html += "       </div>"
  html += '       <div class="col-12 margin_top_s position_relative">'
  html += '          <input type="text" name="" placeholder="인증번호" />'
  html += "       </div>"
  html += "     </div>"
  html += "  </form>"
  html += "</div>"
  modal("정보수정하기", html, savePhone)
}

function modalHomeProgress(id) {

  $("#mypage_home_modal").modal()
  var selected = id;
  var html = ""
  $.ajax({
      url: "../mypage/find_corp.php",
      data: {

        uid: selected,
      },
      type: "POST",
      dataType: "json"
    })
    .done(function (json) {
      html += '<div class="container padding_xl">'
      html += '  <div class="row">'
      html +=
        '    <div class="col-12"><span class="padding_v_s padding_m font_weight_b back_g_l" style="border-radius: 20px;">' + json[0]['type'] + '</span></div>'
      html += '    <div class="col-12 font_size_ll font_weight_b margin_top_m">'
      html += json[0]['name']
      html += '      <svg class="margin_left_s" xmlns="http://www.w3.org/2000/svg"'
      html +=
        '            style="fill:#f7a22f; width: 24px;margin-bottom: 4px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'
      html += "    </div>"
      html +=
        '    <div class="col-12 font_size_s color_g margin_top_s">' + json[0]['desc'] + '</div>'
      html += "  </div>"
      html += "</div>"
      html += '<div class="line"></div>'
      html += '<div class="container padding_xl">'
      html += '  <div class="row">'
      html += '    <div class="col-12">'
      html += '      <img src="../mypage/corp_images/' + json[0]['logo'] + '" style="width:287px;max-width: 100%;"/>'
      html += "    </div>"
      html += '    <div class="col-12 font_weight_b margin_top_m font_size_m">' + json[0]['name'] + '</div>'
      html += '    <div class="col-12 margin_top_m">'
      html += json[0]['det']
      html += "    </div>"
      html += "  </div>"
      html += "</div>"
      $("#mypage_home_modal_result").html(html)
    });



}

function hoverProgress(obj) {
  var self = $(obj)
  if (self.find("svg.arrow").hasClass("rotate_180")) {
    self.find("svg.arrow").removeClass("rotate_180")
    self
      .closest(".progress_step")
      .next(".progress_step_detail")
      .slideUp()
  } else {
    self.find("svg.arrow").addClass("rotate_180")
    self
      .closest(".progress_step")
      .next(".progress_step_detail")
      .slideDown()
  }
}

function hoverViewFinished() {
  var finished = $(".progress_finished")
  if (finished.eq(0).hasClass("display_none")) {
    finished.removeClass("display_none")
  } else {
    finished.addClass("display_none")
  }
}

var diagnosePage = {
  mode: "premium",
  list: [],
  listPerPage: 10,
  noPerPage: 5, // 홀수로 설정해주세요!
  tab: $("#diagnose_tab"),
  approachTable: $("#diagnose_approach_table"),
  competitivePagination: $("#diagnose_competitive_pagination"),
  updateApproach: function (uid) {

    $.ajax({
        url: "../mypage/findview.php",
        data: {

          uid: uid,
        },
        type: "POST",
        dataType: "json"
      })
      .done(function (json) {

        diagnosePage.updateCompetitive(json);

      });
  },


  updateCompetitive: function (json) {
    // mode(diagnosePage.mode)에 따른 api 조회
    var total = 111 // 게시글 전체 갯수, api 조회 필요
    var html = ""
    $.each(row, function (idx, json) {
      html += "<tr>"
      html += '  <td class="text_align_right">'
      html +=
        '    '
      html += "  </td>"
      html += '  <td class="text_align_center tablet">' + row["no"]
      '+</td>'
      html +=
        '  <td><div>' + row['juso']
      '+</div><div class="color_g margin_top_ss mobile">' + row['date'] + '</div></td>'
      html += '  <td class="text_align_center tablet">' + row['date'] + '</td>'
      html += "  <td>"
      html +=
        '    '
      html += "  </td>"
      html += "</tr>"
    });
    diagnosePage.competitiveTable.html(html),
      pagination(
        diagnosePage.competitivePagination,
        total,
        diagnosePage.listPerPage,
        diagnosePage.noPerPage,
        pageNo,
        "diagnosePage.updateCompetitive"
      ) // common.js
  },
  tabDiagnose: function (mode) {
    diagnosePage.mode = mode
    diagnosePage.updateApproach()
    diagnosePage.updateCompetitive(1)
    var tabItems = diagnosePage.tab.find(".tab_item")
    tabItems.removeClass("selected")
    if (mode === "premium") {
      tabItems.first().addClass("selected")
    } else {
      tabItems.last().addClass("selected")
    }
  },
  hoverList: function (e) {
    var val = e.value
    var finded = diagnosePage.list.indexOf(val)
    if (finded === -1) {
      diagnosePage.list.push(val)
    } else {
      diagnosePage.list.splice(finded, 1)
    }
  },
  deleteList: function () {
    var list = diagnosePage.list
    if (list.length === 0) {
      modal("채팅 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("채팅 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        list.join(",")
      )
    }
  }
}

var progressPage = {
  distance: 0,
  percentage: 0,
  newPercentage: 0,
  stepElements: $(".progress_step"),
  element: $("#progress_percentage"),
  hoverStep: function (obj) {},
  setProgressBar: function () {
    progressPage.newPercentage - progressPage.percentage

    function updateNumber() {
      progressPage.element.css("width", progressPage.percentage + "%")
      progressPage.element.find("div").html(progressPage.percentage + "%")
      setTimeout(function () {
        if (progressPage.percentage === progressPage.newPercentage) {
          progressPage.newPercentage = 0
        } else {
          if (progressPage.percentage > progressPage.newPercentage) progressPage.percentage--
          else progressPage.percentage++
          updateNumber()
        }
      }, 5)
    }
    updateNumber(progressPage.percentage)
  }
}

function selectform(e) {
  var forms = window.document.getElementById('forms');



}

var chatPage = {
  filter: "all",
  list: [],
  listPerPage: 10,
  noPerPage: 5, // 홀수로 설정해주세요!
  chatTable: $("#chat_table"),
  chatPagination: $("#chat_pagination"),
  updateTable: function (filter, uid) {
    //alert(uid);
    $.ajax({
        url: "../mypage/findchat.php",

        data: {
          filter: filter,
          uid: uid,
        },
        type: "POST",
        dataType: "json"
      })
      .done(function (json) {

        chatPage.settable(json);
      });
  },
  settable: function (chats) {
    var html = ""

    $.each(chats, function (idx, chat) {

      html += "<tr>"
      html += '  <td class="text_align_right">'
      html += '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="chatPage.hoverList(this)">'
      html += "  </td>"
      html += '  <td class="text_align_center tablet">' + chat["no"] + '</td>'
      html += '  <td><div class="font_size_s mobile"><span class="color_g">' + chat["date"] + '</span><span class="color_b margin_left_ss">' + chat["type"] + '</span></div><div>' + chat["title"] + '</div></td>'
      html += '  <td class="text_align_center color_b tablet">' + chat["type"] + '</td>'
      html += '  <td class="text_align_center tablet">' + chat["date"] + '</td>'
      html += "  <td>"
      html += '<a href = "chat_detail.php?id=' + chat["id"] + '">'
      html +=
        '    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>'
      html += '</a>'
      html += "  </td>"
      html += "</tr>"
    });
    chatPage.chatTable.html(html)

    // common.js
  },
  selectFilter: function (filter, uid) {
    chatPage.filter = filter
    chatPage.uid = uid
    chatPage.updateTable(filter, uid)
  },
  hoverList: function (e) {
    var val = e.value
    var finded = chatPage.list.indexOf(val)
    if (finded === -1) {
      chatPage.list.push(val)
    } else {
      chatPage.list.splice(finded, 1)
    }
  },
  deleteList: function () {
    var list = chatPage.list
    if (list.length === 0) {
      modal("채팅 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("채팅 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        list.join(",")
      )
    }
  }
}

var payPage = {
  listPerPage: 10,
  noPerPage: 5, // 홀수로 설정해주세요!
  table: $("#pay_table"),
  pagination: $("#pay_pagination"),
  updateTable: function (pageNo) {
    // api 조회
    total = 1111 // api 조회
    var html = ""
    html += "<tr>"
    html += '  <td class="text_align_center">000000</td>'
    html += '  <td class="text_align_center">2019.01.02   11:00</td>'
    html += '  <td class="text_align_center">프리미엄이용권</td>'
    html += '  <td class="text_align_center">00,000원</td>'
    html +=
      '  <td class="text_align_center color_b" onclick="payPage.showPayDetail(1)">자세히보기</td>'
    html += '  <td class="color_b" onclick="payPage.openReceipt(0)()">'
    html += "    영수증보기"
    html +=
      '    <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>'
    html += "  </td>"
    html += "</tr>"
    payPage.table.html(html)
    pagination(
      payPage.pagination,
      total,
      payPage.listPerPage,
      payPage.noPerPage,
      pageNo,
      "payPage.updateTable"
    ) // common.js
  },
  showPayDetail: function (id) {
    // 데이터 조회
    var html = ""
    html += '<table class="detail_table">'
    html += "  <tbody>"
    html += "    <tr>"
    html += '      <th style="width: 90px;" class="back_g_l">ID</th>'
    html += "      <td>000000</td>"
    html += "    </tr>"
    html += "    <tr>"
    html += '      <th style="width: 90px;" class="back_g_l">결제 일시</th>'
    html += "      <td>2019.01.20</td>"
    html += "    </tr>"
    html += "    <tr>"
    html += '      <th style="width: 90px;" class="back_g_l">내용</th>'
    html += "      <td>프리미엄이용권</td>"
    html += "    </tr>"
    html += "    <tr>"
    html += '      <th style="width: 90px;" class="back_g_l">결제 방법</th>'
    html += "      <td>BC카드, **** **** **** 5678</td>"
    html += "    </tr>"
    html += "    <tr>"
    html += '      <th style="width: 90px;" class="back_g_l">'
    html += "        <div>기본 요금</div>"
    html += "        <div>추가 요금</div>"
    html += "        <div>쿠폰 할인</div>"
    html += "      </th>"
    html += "      <td>"
    html += "        <div>00,000원</div>"
    html += "        <div>-</div>"
    html += "        <div>-</div>"
    html += "      </td>"
    html += "    </tr>"
    html += "  </tbody>"
    html += "</table>"
    modal("결제 상세", html, payPage.openReceipt(id), "영수증 보기 ❯") // common.js
  },
  openReceipt: function (id) {
    return function () {
      window.open("https://naver.com/" + id)
    }
  }
}

var estimatePage = {
  filter: "all",
  uid: 0,
  filter2: "all",
  uid2: 0,
  listPerPage: 10,
  list: [],
  modalList: [],
  lastId: null,
  noPerPage: 5, // 홀수로 설정해주세요!
  table: $("#estimate_table"),
  table2: $("#estimate_table2"),
  pagination: $("#estimate_pagination"),
  updateTable: function (filter, uid) {
    //alert(uid);
    $.ajax({
        url: "../member/findform.php",

        data: {
          filter: filter,
          uid: uid,
        },
        type: "POST",
        dataType: "json"
      })
      .done(function (json) {

        estimatePage.settable(json);
      });
  },
  updateTable2: function (filter, uid) {
    $.ajax({
        url: "../member/findanswer.php",

        data: {
          filter: filter,
          uid: uid,
        },
        type: "POST",
        dataType: "json"
      })
      .done(function (json) {
        estimatePage.settable2(json)
        //alert(json)
      })
  },
  settable: function (forms) {
    var html = ""
    $.each(forms, function (idx, form) {

      html += "<tr>"
      html += '  <td class="text_align_right">'
      html += '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="estimatePage.hoverList(this)">'
      html += "  </td>"
      html += '  <td class="text_align_center tablet">' + form["no"] + '</td>'
      html += '  <td class="text_align_center">' + form["type"] + '</td>'
      html += '  <td class="text_align_center">' + form["date"] + '</td>'
      html += '  <td class="color_b">'
      html += '    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>'
      html += "  </td>"
      html += "</tr>"

    });
    estimatePage.table.html(html)
    // pagination(
    //   estimatePage.pagination,
    //   total,
    //   estimatePage.listPerPage,
    //   estimatePage.noPerPage,
    //   pageNo,
    //   "estimatePage.updateTable"
    // ) // common.js
  },
  settable2: function (forms) {
    var html = ""
    $.each(forms, function (idx, form) {

      html += "<tr>"
      html += '  <td class="text_align_right">'
      html += '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="estimatePage.hoverList(this)">'
      html += "  </td>"
      html += '  <td class="text_align_center tablet">' + form["no"] + '</td>'
      html += '  <td class="text_align_center">' + form["type"] + '</td>'
      html += '  <td class="text_align_center">' + form["date"] + '</td>'
      html += '  <td class="color_b">'
      html += '    <a href = "estimate_detail.php?type=' + form['type'] + '&id=' + form['id'] + '"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>>/a>'
      html += "  </td>"
      html += "</tr>"

    });
    //alert(html)
    estimatePage.table2.html(html)
    // pagination(
    //   estimatePage.pagination,
    //   total,
    //   estimatePage.listPerPage,
    //   estimatePage.noPerPage,
    //   pageNo,
    //   "estimatePage.updateTable"
    // ) // common.js
  },
  selectFilter: function (filter, uid) {

    estimatePage.filter = filter
    estimatePage.uid = uid
    estimatePage.updateTable(filter, uid)
  },
  selectFilter2: function (filter, uid) {
    estimatePage.filter2 = filter
    estimatePage.uid2 = uid
    // alert(filter)
    // alert(uid)
    estimatePage.updateTable2(filter, uid)
  },
  hoverList: function (e) {
    var val = e.value
    var finded = estimatePage.list.indexOf(val)
    if (finded === -1) {
      estimatePage.list.push(val)
    } else {
      estimatePage.list.splice(finded, 1)
    }
  },
  deleteList: function () {
    var list = estimatePage.list
    if (list.length === 0) {
      modal("견적서요청 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("견적 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        list.join(",")
      )
    }
  },
  modal_estimate_table: function (title, mode) {
    var modal = $("#estimate_modal")
    estimatePage.lastId = 10
    // 더보기 눌렀을 경우 기존 mode를 사용
    if (!mode) mode = estimatePage.mode
    else {
      estimatePage.mode = mode
      modal.find(".estimate_table").html("")
    }
    // 모드에 따른 api 조회
    // 모드가 undefined일 경우
    // estimatePage.lastId === null 일 경우는 첫페이지
    // estimatePage.lastId 가 있을 경우는 lastId를 기준으로 특정 갯수만큼 api 조회
    // api에서 마지막 데이터의 아이디 혹은 count를 저장 후 다음번 조회에서 사용

    var html = ""
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="estimatePage.hoverModalList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center">문디자인</td>'
    html += '  <td class="text_align_center">2019.01.02</td>'
    html +=
      '  <td class="text_align_center color_b">견적서 다운받기<svg class="fill_b margin_left_ss" style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></td>'
    html +=
      '  <td class="text_align_center">상세보가<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="2" onclick="estimatePage.hoverModalList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center">문디자인</td>'
    html += '  <td class="text_align_center">2019.01.02</td>'
    html +=
      '  <td class="text_align_center color_b">견적서 다운받기<svg class="fill_b margin_left_ss" style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></td>'
    html +=
      '  <td class="text_align_center">상세보가<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="3" onclick="estimatePage.hoverModalList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center">문디자인</td>'
    html += '  <td class="text_align_center">2019.01.02</td>'
    html +=
      '  <td class="text_align_center color_b">견적서 다운받기<svg class="fill_b margin_left_ss" style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></td>'
    html +=
      '  <td class="text_align_center">상세보가<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="4" onclick="estimatePage.hoverModalList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center">문디자인</td>'
    html += '  <td class="text_align_center">2019.01.02</td>'
    html +=
      '  <td class="text_align_center color_b">견적서 다운받기<svg class="fill_b margin_left_ss" style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></td>'
    html +=
      '  <td class="text_align_center">상세보가<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="5" onclick="estimatePage.hoverModalList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center">문디자인</td>'
    html += '  <td class="text_align_center">2019.01.02</td>'
    html +=
      '  <td class="text_align_center color_b">견적서 다운받기<svg class="fill_b margin_left_ss" style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></td>'
    html +=
      '  <td class="text_align_center">상세보가<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    modal.find(".modal-title").html(title)
    modal.find(".estimate_table").append(html)
    modal.modal()
  },
  hoverModalList: function (e) {
    var val = e.value
    var finded = estimatePage.modalList.indexOf(val)
    if (finded === -1) {
      estimatePage.modalList.push(val)
    } else {
      estimatePage.modalList.splice(finded, 1)
    }
  },
  deleteModalList: function () {
    var modalList = estimatePage.modalList
    if (modalList.length === 0) {
      modal("견적서 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("견적서 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        estimatePage.modalList.join(",")
      )
    }
  }
}

function hoverLike(id, obj) {

  var self = $(obj)
  if (self.hasClass("display_none")) {
    self.removeClass("display_none")
    self.siblings("svg").addClass("display_none")
  } else {
    self.addClass("display_none")
    self.siblings("svg").removeClass("display_none")
  }
}

function writethis(e) {
  var user1 = e.u_id1.value
  var user2 = e.u_id2.value
  var coach_id = e.coach_id.value
  var name = e.u_name.value
  var msg = e.msg.value
  if (msg == "") {
    alert("메세지를 입력해주세요!")
  } else {
    $.ajax({
      url: "../mypage/write.php",
      type: "POST",
      data: {
        user1: user1,
        user2: user2,
        coach_id: coach_id,
        name: name,
        msg: msg
      },
      cache: false,
      success: function (dataResult) {
        var dataResult = JSON.parse(dataResult)
        if (dataResult.statusCode == 200) {
          e.msg.value = ""
        } else alert("Error!")
      }
    })
  }
}

var chatListPage = {
  timer: null,
  chatList: [],

  getSelected: function () {
    var selected = null
    for (var i = 0; i < chatListPage.chatList.length; i++) {
      var li = chatListPage.chatList[i]
      if (li.selected) {
        selected = li
        break
      }
    }
    return selected
  },

  setChatList: function () {
    var chatListArea = $("#chat_list_area")
    var html = ""
    for (var i = 0; i < chatListPage.chatList.length; i++) {
      var li = chatListPage.chatList[i]
      if (!li.searched) continue
      html += '<div class="col-12 margin_top_m"><div class="line"></div></div>'
      html +=
        '<div class="col-12 margin_top_m cursor_pointer" onclick="chatListPage.loadChat(' +
        li.chatId +
        ')">'
      html += '  <div class="container">'
      html += '    <div class="row align-items-center">'
      html +=
        '      <div class="col profile" style="-ms-flex: 0 0 50px;flex: 0 0 50px;background-image: url(../assets/default_profile_company.svg)"></div>'
      html += '      <div class="col">'
      html += '        <div class="font_weight_b">' + li.name + "</div>"
      html += '        <div class="row">'
      html += '          <div class="col ellipsis color_g font_size_s">' + li.lastText + "</div>"
      html +=
        '          <div class="col color_g font_size_s" style="-ms-flex: 0 0 85px;flex: 0 0 85px;padding: 0;">' +
        timeFormat(li.updatedAt, "calendar") +
        "</div>"
      html += "        </div>"
      html += "      </div>"
      html += "    </div>"
      html += "  </div>"
      html += "</div>"
    }
    chatListArea.html(html)
  },

  hoverChatList: function () {
    var chatList = $("#chat_list")
    var chatDetail = $("#chat_detail")

    if (chatList.hasClass("opened")) {
      chatList.removeClass("opened")
      chatDetail.addClass("opened")
    } else {
      chatDetail.removeClass("opened")
      chatList.addClass("opened")
    }
  },

  loadChat: function (chatId) {
    // api를 통해 채팅 정보 호출 + chatId
    var html = ""
    var chatArea = $("#chat_area")
    var chatDetailName = $("#chat_detail_name")

    for (var i = 0; i < chatListPage.chatList.length; i++) {
      var li = chatListPage.chatList[i]
      if (li.chatId === chatId) {
        chatDetailName.html(li.name)
        li.selected = true
      } else {
        li.selected = false
      }
    }

    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "    <div>짧게 적으면</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="left_message">'
    html += "    <div>안녕하세요 의료장비업체 입니다.</div>"
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html += "  </div>"
    html += "</div>"
    html += '<div class="col-12">'
    html += '  <div class="right_message">'
    html += '    <div class="font_size_s color_g">오전 02:49</div>'
    html +=
      "    <div>길게 적으면, 적어도 모바일에서는 260정도로 고정되어있고, pc에서는 조금 더 길어도 될것같긴해요. 페북메세지를 참고했는데, 페북은 440으로 했더라구여ㅇㅂㅇ</div>"
    html += "  </div>"
    html += "</div>"

    chatArea.html(html)
    chatListPage.hoverChatList()
  },
  hoverLike: function (u_id, corp_id, obj) {

    var svgs = $(obj).find("svg")
    if (svgs.eq(0).hasClass("display_none")) { //unlike
      $.ajax({
        url: "../mypage/star_off.php",
        data: {
          u_id: u_id,
          corp_id: corp_id
        },
        type: "POST",
        dataType: "json"
      });
      svgs.eq(0).removeClass("display_none")
      svgs.eq(1).addClass("display_none")
    } else { //like
      $.ajax({
        url: "../mypage/star.php",
        data: {
          u_id: u_id,
          corp_id: corp_id
        },
        type: "POST",
        dataType: "json"
      });
      svgs.eq(0).addClass("display_none")
      svgs.eq(1).removeClass("display_none")
    }
  },
  callCompany: function () {
    var selected = chatListPage.getSelected()
    window.open("tel:" + selected.contact)
  },
  searchChat: function (e) {
    clearTimeout(chatListPage.timer)
    chatListPage.timer = setTimeout(function () {
      var text = e.value.trim()
      for (var i = 0; i < chatListPage.chatList.length; i++) {
        var li = chatListPage.chatList[i]
        if (li.name.indexOf(text) > -1 || !text) {
          li.searched = true
        } else {
          li.searched = false
        }
      }
      chatListPage.setChatList()
    }, 200)
  },
  openCompanyDetailModal: function (e) {
    var selected = e;

    $.ajax({
        url: "../mypage/find_corp.php",
        data: {

          uid: selected,
        },
        type: "POST",
        dataType: "json"
      })
      .done(function (json) {
        chatListPage.setprofile(json)



      });

  },
  setprofile: function (json) {

    var html = ""

    html += '<div class="modal-header">'
    html += '  <div class="container">'
    html += '    <div class="row">'
    html += '      <div class="col-12">'
    html +=
      '        <div class="font_size_s font_weight_b back_g_l border_radius_m display_inline_block padding_s">' + json[0]["type"] + '</div>'
    html += '        <div class="margin_top_s">'
    html += '          <span class="font_size_ll font_weight_b">' + json[0]["name"] + '</span>'
    html +=
      '          <svg class="fill_g" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'
    html +=
      '          <svg class="fill_y display_none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'
    html += '          <span class="color_g font_size_s">T. ' + json[0]['phone'] + '</span>'
    html += "        </div>"
    html += '        <div class="margin_top_s color_g">' + json[0]["desc"] + ' </div>'
    // html += "      </div>"
    html += "    </div>"
    html += "  </div>"
    html += '  <button type="button" class="close" data-dismiss="modal" aria-label="Close">'
    html += '    <span aria-hidden="true">&times;</span>'
    html += "  </button>"
    html += "</div>"
    html += "</div>"
    html += '<div id="modal_body" class="modal-body position_relative">'
    html += '  <div class="container">'
    html += '    <div class="row">'
    html += '      <div class="col-12">'
    html += '        <img src="../mypage/corp_images/' + json[0]['logo'] + '"style = "width:287px;max-width: 100%;"/>'
    html += "      </div>"
    html += '      <div class="col-12 font_weight_b margin_top_m">'
    html += json[0]["name"]
    html += "      </div>"
    html += '      <div class="col-12 font_size_s color_g margin_top_m">'
    html += json[0]["det"]
    html += "      </div>"
    html += "    </div>"
    html += "  </div>"
    html += "</div>"


    $("#chat_company_detail_modal")
      .find(".modal-content")
      .html(html)
    $("#chat_company_detail_modal").modal()
  },
  openSelectFile: function () {
    $("#chat_file").click()
  },
  sendFile: function (e) {
    var selected = chatListPage.getSelected()
    // selected.chatId => send file api 호출
    chatListPage.loadChat(selected.chatid)
    alert(e.value)
  },
  sendMessage: function (e) {
    if (window.event.key === "Enter") {
      var text = e.value
      var selected = chatListPage.getSelected()
      // selected.chatId => send message api 호출
      chatListPage.loadChat(selected.chatid)
      e.value = ""
      alert(text)
    }
  }
}

var businessPage = {
  adviceList: [],
  estimateList: [],
  listPerPage: 10,
  noPerPage: 5, // 홀수로 설정해주세요!
  adviceTable: $("#advice_table"),
  estimateTable: $("#estimate_table"),
  advicePagination: $("#advice_pagination"),
  estimatePagination: $("#estimate_pagination"),
  updateAdviceTable: function (pageNo) {
    var total = 1000
    var html = ""
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="businessPage.hoverAdviceList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_cente tablet">2019.10.20</td>'
    html +=
      '  <td style="padding-left: 15px;"><div class="mobile"><span class="color_g">2019.10.20</span><span class="color_r margin_left_m">미응답</span></div><div>이건 어떻게 진행되나요?</div></td>'
    html +=
      '  <td class="text_align_center tablet"><div class="button6 color_r" style="border-color: #ff5353;">미응답</div></td>'
    html +=
      '  <td class="text_align_center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="1" onclick="businessPage.hoverAdviceList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_cente tablet">2019.10.20</td>'
    html +=
      '  <td style="padding-left: 15px;"><div class="mobile"><span class="color_g">2019.10.20</span><span class="color_b margin_left_m">답변완료</span></div><div>이건 어떻게 진행되나요?</div></td>'
    html +=
      '  <td class="text_align_center tablet"><div class="button6 color_b" style="border-color: #2f7cf7;">답변완료</div></td>'
    html +=
      '  <td class="text_align_center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    businessPage.adviceTable.html(html)
    pagination(
      businessPage.advicePagination,
      total,
      businessPage.listPerPage,
      businessPage.noPerPage,
      pageNo,
      "businessPage.updateAdviceTable"
    ) // common.js
  },
  updateEstimateTable: function (pageNo) {
    var total = 1000
    var html = ""
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="0" onclick="businessPage.hoverEstimateList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center tablet">2019.10.20</td>'
    html += '  <td class="text_align_center">엄보혁</td>'
    html += '  <td class="text_align_center">이비인후과</td>'
    html +=
      '  <td class="text_align_center tablet"><div class="button6 color_r" style="border-color: #ff5353;">미응답</div></td>'
    html +=
      '  <td class="text_align_center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    html += "<tr>"
    html += '  <td class="text_align_right">'
    html +=
      '    <input class="form-check-input position-static" type="checkbox" value="0" onclick="businessPage.hoverEstimateList(this)">'
    html += "  </td>"
    html += '  <td class="text_align_center tablet">10</td>'
    html += '  <td class="text_align_center tablet">2019.10.20</td>'
    html += '  <td class="text_align_center">엄보혁</td>'
    html += '  <td class="text_align_center">이비인후과</td>'
    html +=
      '  <td class="text_align_center tablet"><div class="button6 color_b" style="border-color: #2f7cf7;">발송완료</div></td>'
    html +=
      '  <td class="text_align_center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></td>'
    html += "</tr>"
    businessPage.estimateTable.html(html)
    pagination(
      businessPage.estimatePagination,
      total,
      businessPage.listPerPage,
      businessPage.noPerPage,
      pageNo,
      "businessPage.updateEstimateTable"
    ) // common.js
  },
  deleteAdviceList: function () {
    var list = businessPage.adviceList
    if (list.length === 0) {
      modal("채팅 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("채팅 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        list.join(",")
      )
    }
  },
  deleteEstimateList: function () {
    var list = businessPage.estimateList
    if (list.length === 0) {
      modal("채팅 삭제", "삭제할 아이템을 선택해주세요.", null, "확인") // common.js
      return
    }
    modal("채팅 삭제", "삭제하시겠습니까?", callDelete, "삭제하기") // common.js
    function callDelete() {
      alert(
        "list에 선택된 것들 담아놓았습니다!.\ndelete api 호출하시면 됩니다!!\n선택된 아이디 : " +
        list.join(",")
      )
    }
  },
  hoverAdviceList: function (e) {
    var val = e.value
    var finded = businessPage.adviceList.indexOf(val)
    if (finded === -1) {
      businessPage.adviceList.push(val)
    } else {
      businessPage.adviceList.splice(finded, 1)
    }
  },
  hoverEstimateList: function (e) {
    var val = e.value
    var finded = businessPage.estimateList.indexOf(val)
    if (finded === -1) {
      businessPage.estimateList.push(val)
    } else {
      businessPage.estimateList.splice(finded, 1)
    }
  }
}