  <?php wp_footer(); ?>
  <script>
    $(document).ready(function() {
      var citiesParams = {};
      var districtParams = {};
      citiesParams = {
        "header": "Выберите город"
      };
      districtParams = {
        "header": "Выберите район"
      };
      $('#cities').tinyNav(citiesParams);
      $('#districts').tinyNav(districtParams);

    });
  </script>
  <script>
  $(document).ready(function() {

    $(".toggle").click(function() {
      $(".hidemenu").slideToggle();
    });
    var currentUrl = window.location.href;
    $('div.menu ul li a').each(function(index, value) {
      if ($(this).prop("href") === currentUrl) {
        $(this).parent().addClass("selected");
      }
    });

  });
  </script>
</div>

</body>
</html>
