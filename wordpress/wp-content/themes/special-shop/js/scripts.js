/*! http://tinynav.viljamis.com v1.2 by @viljamis */
(function(a, k, g) {
  a.fn.tinyNav = function(l) {
    var c = a.extend({
      active: "selected",
      header: "",
      indent: "- ",
      label: ""
    }, l);
    return this.each(function() {
      g++;
      var h = a(this),
        b = "tinynav" + g,
        f = ".l_" + b,
        e = a("<select/>").attr("id", b).addClass("tinynav " + b);
      if (h.is("ul,ol")) {
        "" !== c.header && e.append(a("<option/>").text(c.header));
        var d = "";
        h.addClass("l_" + b).find("a").each(function() {
          d += '<option value="' + a(this).attr("href") + '">';
          var b;
          for (b = 0; b < a(this).parents("ul, ol").length - 1; b++) d += c.indent;
          d += a(this).text() + "</option>"
        });
        e.append(d);
        c.header || e.find(":eq(" + a(f + " li").index(a(f + " li." + c.active)) + ")").attr("selected", !0);
        e.change(function() {
          k.location.href = a(this).val()
        });
        a(f).after(e);
        c.label && e.before(a("<label/>").attr("for", b).addClass("tinynav_label " + b + "_label").append(c.label))
      }
    })
  }
})(jQuery, this, 0);

function longnavi() {
  var counter = 0;
  if ($('div.header').width() > $('div.inner').width() && $(window).width() > 640) {
    $('div.menu > ul').append('<li class="more"><a href="#" class="more_btn">Ещё</a></li>');
    while ($('div.header').width() > $('div.inner').width() && counter < 100) {
      $('div.menu > ul > li:not(.more):visible:last').hide();
      counter++;
    }
    $('div.menu > ul li:hidden').wrapAll('<div class="more_nav"></div>');
    $("div.more_nav").css("top", ($("div.menu > ul").height() - 2));
    $("div.more_nav").appendTo("li.more");
    $('div.more_nav li:hidden').each(function() {
      $(this).show().css('display', 'inline-block');
    });
  }

}
$(document).ready(function() {
  $(document).on("mouseenter", "li.more", function() {
    $("div.more_nav").slideDown(100);
  });

  $(document).on("mouseleave", "nav, li.more", function() {
    $("div.more_nav").slideUp(100);
  });
  longnavi();

  $(window).on("orientationchange resize load", function() {
    longnavi();
  });
});
