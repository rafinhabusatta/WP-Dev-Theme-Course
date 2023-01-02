<?php

require get_theme_file_path('/inc/search-route.php');

function aladvogados_custom_rest() {
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author();}
  ));
}
add_action('rest_api_init', 'aladvogados_custom_rest');

function pageBanner($args = NULL) {
  if (!$args['title']) {
    $args['title'] = get_the_title();
  }

  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!$args['photo']) {
    if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

  ?>
  <div class="container-fluid">
    <div class="row bg-blue header-banner text-center" style="background-image: url(<?php echo $args['photo']?>); background-repeat: no-repeat; background-size: cover;">
      <div class="col-12">
        <div class="row mx-0 mx-md-4 px-2">
          <div class="col-12 px-md-0">
            <h1 class="text-center text-gold my-4 text-uppercase fw-bold fs-32 fs-lg-65">
              <?php 
                echo $args['title'];
                // if (is_category()) {
                //  single_cat_title();
                // }
                // if (is_author()) {
                //   echo  'Posts by '; the_author();
                // } ?></h1>
          </div>
        </div>
        <div class="row mx-0 mx-md-4 px-2">
          <div class="col-12 px-md-0 m-xl-auto">
            <p class="class-justify">
              <?php echo $args['subtitle'] ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }

function aladvogados_files() {
  wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
  wp_enqueue_style('bootstrap_css', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
  wp_enqueue_style('aladvogados_main_styles', get_stylesheet_uri());
  wp_enqueue_script('bootstrap_js', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', NULL, '1.0', true);
  wp_enqueue_script('aladvogados_main_js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB8SrX1XO1i1s6xEPiIBlm19cpoa35hA78', NULL, '1.0', true);

  wp_localize_script('aladvogados_main_js', 'data', array(
    'root_url' => get_site_url()
  ));

}
add_action('wp_enqueue_scripts', 'aladvogados_files');

function aladvogados_features() {
  // register_nav_menu('headerMenuLocation', 'Header Menu Location');
  // register_nav_menu('FooterLocationOne', 'Footer Location One');
  // register_nav_menu('FooterLocationTwo', 'Footer Location Two');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true); //width, height, crop
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'aladvogados_features');

function aladvogados_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
      ));
  }
}
add_action('pre_get_posts', 'aladvogados_adjust_queries');

function aladvogadosMapKey($api) {
  $api['key'] = 'AIzaSyB8SrX1XO1i1s6xEPiIBlm19cpoa35hA78';
  return $api;
}
add_filter('acf/fields/google_map/api', 'aladvogadosMapKey');