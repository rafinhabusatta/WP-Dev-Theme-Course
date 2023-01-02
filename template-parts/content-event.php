<div class="col-12 col-md-6 col-lg-4">
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title"><?php the_title(); ?></h5>
      <p>
        Data: <?php 
          $eventDate = new DateTime(get_field('event_date'));
          echo $eventDate->format('d/m/y') ?>
      </p>
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