<?php
  get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
?>
<div class="container">
  <div class="row mx-0 mt-5">
    <div class="col-12 col-lg-4">
      <img src="<?php the_post_thumbnail_url('professorPortrait'); ?>" class="img-thumbnail" alt="Professor <?php the_title(); ?>">
    </div>
    <div class="col-12 col-lg-4">
      <?php the_content(); ?>
    </div>
    <div class="col-1">
      <?php 
        $likeCount = new WP_Query(array(
          'post_type' => 'like',
          'meta_query' => array(
            array(
              'key' => 'liked_professor_id',
              'compare' => '=',
              'value' => get_the_ID()
            )
          ),
        ));

        $existStatus = 'no';

        if(is_user_logged_in()){
          $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
              array(
                'key' => 'liked_professor_id',
                'compare' => '=',
                'value' => get_the_ID()
              )
            ),
          ));
  
          if($existQuery->found_posts) {
            $existStatus = 'yes';
          }
        }  
      ?>
      <span class="btn btn-light ms-auto text-danger like-box" data-exists="<?php echo $existStatus; ?>" data-professor='<?php the_id(); ?>' data-like="<?php echo $existQuery->posts[0]->ID;?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
          <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
        </svg>
        <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
      </span>
     
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