<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <nav class="navbar navbar-dark navbar-expand-lg bg-blue">
    <?php 
      // wp_nav_menu(array(
      //   'theme_location' => 'headerMenuLocation',
      //   'container' => 'div',
      //   'container_class' => 'container-fluid',
      //   'container_id' => 'navbarSupportedContent',
      //   'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
      //   'add_li_class' => 'nav-item'
      // ));
    ?>
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="<?php echo get_theme_file_uri('assets/Logo.svg'); ?>" alt="Logo" height="100" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a <?php if (is_page('home') or wp_get_post_parent_id(0) == 31) echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo site_url(); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 10) echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo site_url('/about-us'); ?>">Sobre</a>
          </li>
          <li class="nav-item">
            <a <?php if ( get_post_type() == 'post') echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo site_url('/noticias'); ?>">Notícias</a>
          </li>
          <li class="nav-item">
            <a <?php if ( get_post_type() == 'event' OR is_page('past-events')) echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo get_post_type_archive_link('event'); ?>">Eventos</a>
          </li>
          <li class="nav-item">
            <a <?php if ( get_post_type() == 'program' OR is_page('programs')) echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo get_post_type_archive_link('program'); ?>">Programas</a>
          </li>
          <li class="nav-item">
            <a <?php if ( get_post_type() == 'campus' OR is_page('campuses')) echo 'class="nav-link active" aria-current="page"' ?> class="nav-link" href="<?php echo get_post_type_archive_link('campus'); ?>">Campi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <!-- <input
            class="form-control me-2"
            type="search"
            placeholder="Pesquisar"
            aria-label="Pesquisar"
          /> -->
          <span class="btn btn-outline-success js-search-trigger" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </span>
        </form> 
      </div>
    </div>
  </nav>
</header>
  
