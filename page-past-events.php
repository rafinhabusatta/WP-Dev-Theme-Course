<?php get_header();
  pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
  ));
?>
  <!-- past events page -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <?php
          $today = date('Ymd');
          $pastEvents = new WP_QUERY(array(
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
              )
            )
          ));

          while($pastEvents->have_posts()) {
            $pastEvents->the_post();
            get_template_part('template-parts/content-event');
          }
          ?>
        </div>
      </div>
    </div>
    <?php echo paginate_links(array(
      'total' => $pastEvents->max_num_pages
    )); ?>
  </div>
<?php  get_footer(); ?>