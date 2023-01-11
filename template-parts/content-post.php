<div class="col-12 col-md-6 col-lg-4">
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title"><?php the_title(); ?></h5>
      <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('d/m/Y'); ?> in <?php echo get_the_category_list(', '); ?></p>
      <p class="card-text"><?php echo wp_trim_words(get_the_content(), 18); ?></p>
      <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
    </div>
  </div>
</div>