<?php get_header();
  pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'See what is going on in our world.'
  ));
?>
  <!-- archive for events -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <?php
          while(have_posts()) {
            the_post();
            get_template_part('template-parts/content-event');
          }
          ?>
        </div>
      </div>
    </div>
    <?php echo paginate_links(); ?>
    <hr>
    <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events archive</a></p>
  </div>
<?php  get_footer(); ?>