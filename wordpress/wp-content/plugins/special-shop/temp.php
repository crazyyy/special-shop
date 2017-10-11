/** First Time Init */
global $snd_db_version;
$snd_db_version = "1.0";
/** install plugin, create new DB */
register_activation_hook(__FILE__,'snd_install');
function snd_install () {
  global $wpdb;
  global $snd_db_version;

  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . "specshop";

  if( $wpdb->get_var("show tables like '$table_name'") != $table_name) {

    $sql = "CREATE TABLE " . $table_name . " (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      name text NOT NULL,
      url text NOT NULL,
      text text NOT NULL,
      image text NOT NULL,
      type text NOT NULL,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      views smallint(5) NOT NULL,
      clicks smallint(5) NOT NULL,
      UNIQUE KEY id (id)
      ) " . $charset_collate . ";";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

      dbDelta($sql);

      add_option("snd_db_version", $snd_db_version);
   }
}

/** Submit Functions */
add_action( 'wp_ajax_snd_form_add', 'snd_form_add' ); //admin side
add_action( 'wp_ajax_nopriv_snd_form_add', 'snd_form_add' ); //for frontend
function snd_form_add(){
  global $wpdb;

  $table_name = $wpdb->prefix . "specshop";

  $post_name = $_POST['data']['name'];
  $post_url = $_POST['data']['url'];
  $post_content = $_POST['data']['text'];
  $post_image = $_POST['data']['image'];
  $post_type = $_POST['data']['type'];

  $insert_row = $wpdb->insert(
    $table_name,
      array(
        'name' => $post_name,
        'url' => $post_url,
        'text' => $post_content,
        'image' => $post_image,
        'type' => $post_type,
        'time' => current_time('mysql')
      ),
      array( '%s', '%s' )
  );

  if ( $insert_row == 1 ){
    $response_status = "true";
  } else {
    $response_status = "false";
  }

  echo $wpdb->insert_id;
  exit(); //prevent 0 in the return
}
/** Remove Row From DB Function */
add_action( 'wp_ajax_snd_form_remove', 'snd_form_remove' ); //admin side
add_action( 'wp_ajax_nopriv_snd_form_remove', 'snd_form_remove' ); //for frontend
function snd_form_remove(){
  global $wpdb;

  $table_name = $wpdb->prefix . "specshop";

  $post_id = $_POST['data']['id'];

  $remove_row = $wpdb->delete(
    $table_name,
      array(
        'id' => $post_id
      ),
      array( '%d' )
  );

  if ( $remove_row == 1 ){
    $remove_status = "true";
  } else {
    $remove_status = "false";
  }
  echo $remove_status;
  exit(); //prevent 0 in the return
}

/** Remove Row From DB Function */
add_action( 'wp_ajax_snd_form_edit', 'snd_form_edit' ); //admin side
add_action( 'wp_ajax_nopriv_snd_form_edit', 'snd_form_edit' ); //for frontend
function snd_form_edit(){
  global $wpdb;

  $table_name = $wpdb->prefix . "specshop";

  $post_id = $_POST['data']['id'];

  $results = $wpdb->get_results("SELECT name, url, text, image, type, time, views, clicks FROM $table_name WHERE id = " . $post_id . " ");

  if (!$results) {
    echo "Not found in DB\n";
  }

  echo json_encode($results[0]);
  exit(); //prevent 0 in the return
}
/** Update Form Functions */
add_action( 'wp_ajax_snd_form_update', 'snd_form_update' ); //admin side
add_action( 'wp_ajax_nopriv_snd_form_update', 'snd_form_update' ); //for frontend
function snd_form_update(){
  global $wpdb;

  $table_name = $wpdb->prefix . "specshop";

  $post_id = $_POST['data']['id'];
  $post_name = $_POST['data']['name'];
  $post_url = $_POST['data']['url'];
  $post_content = $_POST['data']['text'];
  $post_image = $_POST['data']['image'];
  $post_type = $_POST['data']['type'];

  $insert_row = $wpdb->update(
    $table_name,
      array(
        'name' => $post_name,
        'url' => $post_url,
        'text' => $post_content,
        'image' => $post_image,
        'type' => $post_type,
        'time' => current_time('mysql')
      ),
      array( 'id' => $post_id ),
      array( '%s', '%s' )
  );

  if ( $insert_row == 1 ){
    $response_status = "true";
  } else {
    $response_status = "false";
  }

  echo $wpdb->insert_id;
  exit(); //prevent 0 in the return
}

// Add Shortcode
function specshop_shortcode( $atts ) {

  global $wpdb;
  $table_name = $wpdb->prefix . "specshop";

  // Attributes
  $atts = shortcode_atts(
    array(
      'id' => '',
      'col' => '',
      'fz' => '',
      'fs' => '',
      'fw' => '',
      'color' => '',
      'imgbd' => '',
      'imgbdc' => '',
      'bgc' => '',
      'bd' => '',
      'bdc' => '',
      'pad' => '',
      'm' => '0.5',
      'h' => '',
      'w' => '',
      'mw' => '',
      'a' => '',
    ),
    $atts,
    'specshop'
  );
  $ids = explode(",",$atts['id']);
  $counter = intval(count($ids));
  $columns = intval($atts['col']);

  if ($atts['fz']) {
    $fz = 'font-size: '. $atts['fz'] .'px;';
  }

  if ($atts['fs']) {
    $fs = 'font-style: '. $atts['fs'] .';';
  }

  if ($atts['fw']) {
    $fw = 'font-weight: '. $atts['fw'] .';';
  }

  if ($atts['color']) {
    $color = 'color: '. $atts['color'] .';';
  }

  if ($atts['imgbd']) {
    $imgbd = 'border: '. $atts['imgbd'] .'px solid transparent;';
  }

  if ($atts['imgbdc']) {
    $imgbdc = 'border-color: '. $atts['imgbdc'] .';';
  }

  if ($atts['bgc']) {
    $bgc = 'background-color: '. $atts['bgc'] .';';
  }

  if ($atts['bd']) {
    $bd = 'border: '. $atts['bd'] .'px solid transparent;';
  }

    if ($atts['bdc']) {
      $bdc = 'border-color: '. $atts['bdc'] .';';
    }

  if ($atts['pad']) {
    $pad = 'padding: '. $atts['bdc'] .'px;';
  }

  if ($atts['h']) {
    $h = 'height: '. $atts['h'] .'px;';
  }

  if ($atts['w']) {
    $w = 'width: '. $atts['w'] .'px;';
  }

  if ( $atts['mw'] == 'a') {
    $mw = 'width: '. $atts['mw'] .'px; margin-left: auto; margin-right: auto;';
  } else {
    $mw = 'width: 100%; margin-left: auto; margin-right: auto;';
  }

  if ( $atts['a'] == 'l') {
    $margin_a = 'margin-left: 0; margin-right:auto;float:none;';
  } else if ( $atts['a'] == 'r') {
    $margin_a = 'margin-right: 0; margin-left:auto;float:none;';
  } else if ( $atts['a'] == 'm') {
    $margin_a = 'margin-right: auto; margin-left:auto;float:none;';
  }

  $href_styles = $fz . $fs . $fw . $color;
  $img_styles = $imgbd . $imgbdc;

   global $content;
    ob_start();


  echo '<!--noindex--><div class="specshop-container" style="'. $mw .'">';

  if ( $columns == 0 ) {

    for ($i=0; $i < $counter ; $i++) {

      $results = $wpdb->get_results("SELECT name, url, text, image, type, time, views, clicks FROM $table_name WHERE id = " . $ids[$i] . " ");

      if (!$results) {
        echo $ids[$i] ." Not found in DB\n";
      }

      $margin = floatval($atts['m']);

      $a = ($margin * 2 * $counter);
      $b = (100 - $a);

      $width = ($b/$counter);

      if ($atts['a']) {
        $margin = $margin_a;
      } else {
        $margin = 'margin-left: '. floatval($atts['m']) .'%; margin-right: '. floatval($atts['m']) .'%;';
      }


      if ($mw) {
        $width = 'width: 100%;';
      } else if ($w) {
        $width = 'width: '. $atts['w'] .'px;';
      } else  {
        $width = 'width: '.  ($b/$counter) .'%;';
      }

      $block_styles = $width . $margin . $bgc . $bd . $bdc . $pad . $h;

      echo '
        <a target="_blank" rel="nofollow" class="specshop-item specshop-item-one '. $results[0]->type .' specshop-item-id-' . $ids[$i] . '" href="' . $results[0]->url . '" style="'. $block_styles . $href_styles .'">
          <img src="' . $results[0]->image . '" alt="" class="sandork-img" style="'. $img_styles .'">
          <span class="sandork-text">' . $results[0]->text . '</span>
        </a><!-- /.specshop-item -->';
    };

  } else {

    for ($i=0; $i < $counter ; $i++) {
      $results = $wpdb->get_results("SELECT name, url, text, image, type, time, views, clicks FROM $table_name WHERE id = " . $ids[$i] . " ");

      if (!$results) {
        echo $ids[$i] ." Not found in DB\n";
      }

      if ($mw) {
        $width = 'width: 100%; margin-left:0; margin-right:0;';
      } else if ($w) {
        $width = 'width: '. $atts['w'] .'px; margin-left:auto; margin-right:auto;';
      } else {
        $width = 'width: '.  ($b/$counter) .'%; margin-left: .5%; margin-right: .5%;';
      }

      $block_styles = $width . $bgc . $bd . $bdc . $pad . $h;

      echo '
        <a target="_blank" rel="nofollow" class="specshop-item  specshop-item-two '. $results[0]->type .' specshop-item-id-' . $ids[$i] . '" href="' . $results[0]->url . '" style="'. $block_styles . $href_styles .'">
          <img src="' . $results[0]->image . '" alt="" class="sandork-img" style="'. $img_styles .'">
          <span class="sandork-text">' . $results[0]->text . '</span>
        </a><!-- /.specshop-item -->';
    };
  }

  echo '</div><!-- /.specshop-container --><!--/noindex-->';

 $output = ob_get_clean();
 return $output;

}
add_shortcode( 'specshop', 'specshop_shortcode' );



function specshop_options_page() {
  include 'specshop-options.php';
}
