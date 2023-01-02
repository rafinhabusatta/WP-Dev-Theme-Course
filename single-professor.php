<?php
  get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
?>
<div class="container">
  <div class="row mx-0 mt-5">
    <div class="col-12 col-lg-8">
      <?php the_content(); ?>
    </div>
    <div class="col-12 col-lg-4">
    <img src="<?php the_post_thumbnail_url('professorPortrait'); ?>" class="img-thumbnail" alt="Professor <?php the_title(); ?>">
    </div>
    <?php 
      $relatedPrograms = get_field('related_programs');
      //print_r($relatedPrograms);
      if($relatedPrograms) {
        echo '<div class="col-12"><h3>Subject(s) Taught</h3><ul>';
        foreach($relatedPrograms as $program) {
          ?>
            <li>
              <a href="<?php echo get_the_permalink($program); ?>">
                <?php echo get_the_title($program); ?>
              </a>
            </li>
          <?php
        }
        echo '</ul>
        </div>';
      }
    ?>
  </div>
</div>

<?php }
  get_footer();
?>