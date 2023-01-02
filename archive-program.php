<?php get_header();
  pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone. Have a look around.'
  ));
?>
  <!-- archive for programs -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <?php
          while(have_posts()) {
            the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card mb-4">
                <div class="card-body">
                  <h5 class="card-title"><?php the_title(); ?></h5>
                  <p class="card-text"><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Apply</a>
                </div>
              </div>
            </div>
          <?php }
          ?>
        </div>
      </div>
    </div>
    <?php echo paginate_links(); ?>
  </div>
<?php  get_footer(); ?>