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
            <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('event'); ?>">Events Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
          </ol>
        </nav>
        <?php the_content(); ?>
      </div>
      <?php 
        $relatedPrograms = get_field('related_programs');
        //print_r($relatedPrograms);
        if($relatedPrograms) {
          echo '<div class="col-12"><h3>Related Program(s):</h3><ul>';
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