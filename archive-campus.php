<?php get_header();
  pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses.'
  ));
?>
  <!-- archive for campuses -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <div class="acf-map">
            <?php
            while(have_posts()) {
              the_post();
              $mapLocation = get_field('map_location');
              //print_r($mapLocation);
              ?>
              <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">

              </div>
            <?php }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo paginate_links(); ?>
  </div>
<?php  get_footer(); ?>