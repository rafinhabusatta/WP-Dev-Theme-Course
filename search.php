<?php get_header();
  pageBanner(array(
    'title' => 'Resultados da Busca',
    'subtitle' => 'Sua busca para &ldquo;' . esc_html(get_search_query(false)) . '&rdquo; retornou 0 resultados.'
  ));
?>
  <!-- generic home page -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <?php
          if(have_posts()){
            while(have_posts()) {
              the_post(); 
              get_template_part('template-parts/content', get_post_type());
            }
          }
          else {
            echo '<h2 class="text-center">Nenhum resultado encontrado.</h2>'
          }
          get_search_form();
          ?>
        </div>
      </div>
    </div>
    <?php echo paginate_links(); ?>
  </div>
<?php  get_footer(); ?>