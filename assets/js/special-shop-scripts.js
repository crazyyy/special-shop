// Avoid `console` errors in browsers that lack a console.
(function() {
  var method;
  var noop = function() {};
  var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd', 'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
      console[method] = noop;
    }
  }
}());
if (typeof jQuery === 'undefined') {
  console.warn('jQuery hasn\'t loaded');
} else {
  console.log('jQuery has loaded');
}
// Place any jQuery/helper plugins in here.
var $ = jQuery;
$(document).ready(function() {
  // set default preference for AJAX
  var data = {
    'url': '/wp-admin/admin-ajax.php'
  };

  // ajax load price and product count from ACF field for taxonomy archive page
  $('.product-container--item').each(function(index, el) {
    var thisId = $(this).attr('id').replace('post-', '');

    data.postid = thisId;
    data.action = 'load_acf_fields';

    var $thisObject = $(this)
    $.post(data.url, data, function(response) {
      var data = JSON.parse(response);
      $thisObject.find('.product-container--price').prepend(data.price)
      $thisObject.find('.product-container--count span').prepend(data.count)
    });
  });


});
