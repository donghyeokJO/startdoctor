function hoverFaq (obj) {
  var area = $(obj).closest('.faq_area');
  var result = area.find('.faq_result');
  var arrow = area.find('.arrow')
  if (arrow.hasClass('rotate_180')) arrow.removeClass('rotate_180')
  else arrow.addClass('rotate_180')
  result.slideToggle();
}