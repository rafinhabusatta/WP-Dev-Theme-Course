<?php
  get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
  ?>
  <div class="container">
    <div class="row mx-0 mt-5">
      <div class="col-12">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('program'); ?>">All programs</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
          </ol>
        </nav>
        <?php the_content(); ?>
      </div>
      <?php
        $relatedProfessors = new WP_QUERY(array(
          'posts_per_page' => -1,
          'post_type' => 'professor',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"' // get_the_ID() is the id of the current program
            )
          )
        ));

        if ($relatedProfessors->have_posts()) {
          echo '<div class="col-12"><h3>Related ' . get_the_title() . ' professors</h3><div class="row">';

          while($relatedProfessors->have_posts()) {
            $relatedProfessors->the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card mb-4">
                <div class="card-body">
                  <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>" class="card-img-top" alt="Professor <?php the_title(); ?>">

                  <h5 class="card-title"><?php the_title(); ?></h5>
                  <p class="card-text">
                    <?php 
                      if(has_excerpt()) {
                        echo get_the_excerpt();
                      }else {
                        echo wp_trim_words(get_the_content(), 18);
                      } 
                    ?>
                  </p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
                </div>
              </div>
            </div>
            <?php } 
        } 
      ?>
      <?php
        wp_reset_postdata(); // reset the query

        $today = date('Ymd');
        $homepageEvents = new WP_QUERY(array(
          'posts_per_page' => 3,
          'post_type' => 'event',
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            ),
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"' // get_the_ID() is the id of the current program
            )
          )
        ));

        if ($homepageEvents->have_posts()) {
          echo '<div class="col-12"><h3>Upcoming ' . get_the_title() . ' events</h3><div class="row">';

          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post();
            get_template_part('template-parts/content-event');
          } wp_reset_postdata();//wp_reset_postdata();
        }?>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <?php }
  get_footer();
?>