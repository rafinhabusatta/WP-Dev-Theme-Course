<?php get_header();  ?>
<div class="header-banner text-center text-lg-start bg-blue themis">
  <?php get_template_part('template-parts/content', 'homeBanner');?>
</div>
<main class="container">
  <div class="row mt-5">
    <div class="col-12 col-lg-6">
      <h2 class="fs-32 fs-lg-48 fw-semibold mb-4 position-relative">
        Sobre Nós<span class="shadow-text">Sobre Nós</span>
      </h2>
      <?php 
        $homepageAboutUs = new WP_Query(array(
          'posts_per_page' => 1,
          'post_type' => 'page',
          'pagename' => 'about-us'
        ));
        
        while($homepageAboutUs->have_posts()) {
          $homepageAboutUs->the_post(); ?>
          <p class="text-justify">
            <?php echo wp_strip_all_tags(get_the_content()); ?>
          </p>
        <?php }
      ?>
    </div>
    <div class="col-12 col-lg-6">
      <img src="<?php echo get_template_directory_uri(); ?>/images/advogado.jpg" alt="Advogado" class="img-fluid bg-blue h-100 w-100">
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <h2 class="fs-32 fs-lg-48 fw-semibold mb-4 position-relative">
        Especialidades<span class="shadow-text">Especialidades</span>
      </h2>
      <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
        <?php
          $homepageSpecialties = new WP_QUERY(array(
            'posts_per_page' => 6,
            'post_type' => 'especialidade',
            'orderby' => 'title',
            'order' => 'ASC'
          ));
          while($homepageSpecialties->have_posts()) {
            $homepageSpecialties->the_post(); 
        ?>
          <div class="col">
            <div class="card bg-blue text-white h-100">
              <div class="card-body">
                <h5 class="card-title fw-bold">
                  <?php the_title(); ?>
                </h5>
                <p class="card-text">
                  <?php the_content(); ?>
                </p>
              </div>
              <div class="card-footer bg-blue border-top-0 pb-4 mb-2">
                  <a href="#" class="btn btn-gold">Saiba mais</a>
                </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="row mt-5 p-5 text-white bg-blue-light">
    <div class="col-12 col-lg-6">
      <h2 class="fs-32 fs-lg-48 fw-semibold mb-4">Atendemos todo
        país remotamente!</h2>
        <p class="text-justify">
          Estamos localizados na praça osvaldo cruz 15, na sala 1905, prontos para atender você! Também estamos disponível online através do whatsapp.
        </p>
        <button type="button" class="btn btn-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
          </svg>
          Whatsapp
        </button>
    </div>
    <div class="col-12 col-lg-6">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d863.5915287956304!2d-51.2228087!3d-30.0263527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9519791d64f85901%3A0xc56f8460c312c4f3!2sCondom%C3%ADnio%20Edif%C3%ADcio%20Coliseu!5e0!3m2!1spt-BR!2sbr!4v1670796572077!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12 col-lg-6">
      <h2 class="fs-32 fw-bold mb-4 text-blue">PLANEJE A SUA APOSENTADORIA CONOSCO</h2>
        <p class="text-justify">
          Fazemos um estudo de projeção financeira para que você possa aproveitar sua aposentadoria ao máximo!
        </p>
        <button type="button" class="btn btn-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
          </svg>
          Whatsapp
        </button>
    </div>
    <div class="d-none d-lg-block col-6">
      <img class="img-fluid" src="<?php echo get_theme_file_uri('assets/SVG/investing.svg'); ?>" alt="Ilustração">
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <h2 class="fs-32 fs-lg-48 fw-semibold mb-4 position-relative">
        Últimas notícias<span class="shadow-text">Últimas notícias</span>
      </h2>
      <div class="row">
        <?php
          $homepagePosts = new WP_Query(array(
            'posts_per_page' => 3));
            // 'category_name' => 'noticias'
            //'post_type' => 'noticias' ou page
          while ($homepagePosts->have_posts()) {
            $homepagePosts->the_post(); ?>
            
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

          <?php } wp_reset_postdata();
        ?>
      </div>
      <button class="btn btn-dark"><a href="<?php echo site_url('/noticias'); ?>">Ver todas as notícias</a></button>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <h2 class="fs-32 fs-lg-48 fw-semibold mb-4 position-relative">
        Eventos<span class="shadow-text">Eventos</span>
      </h2>
      <div class="row">
        <?php
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
              )
            )
          ));

          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post(); 
            get_template_part('template-parts/content', 'event');
            } wp_reset_postdata();
          ?>
      </div>
      <button class="btn btn-dark"><a href="<?php echo get_post_type_archive_link('event'); ?>">Ver todos os eventos</a></button>
    </div>
  </div>
</main>
<?php  get_footer(); ?>