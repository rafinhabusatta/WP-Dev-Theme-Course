<?php
get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
  ?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php 
      $theParent = wp_get_post_parent_id(get_the_ID());
      if ($theParent) { ?>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo get_permalink($theParent); ?>">Back to <?php echo get_the_title($theParent); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
        </ol>
      </nav>
      <?php }
      ?>  
    </div>
  </div>
  <div class="row mx-0 mt-3">
    <?php
    //se a página tiver filhos, retorna um array com os filhos, se não, retorna false
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $testArray) { ?>
      <div class="col-lg-3 d-none d-lg-block mt-5">
        <h3 class="text-uppercase text-blue"><a class="text-blue" href="<?php echo get_the_permalink($theParent) ?>"><?php echo get_the_title($theParent); ?></a></h3>
        <ul class="nav flex-column menu-child">
          <?php 
          if($theParent) {
            $findChildrenOf = $theParent;
        } else {
          $findChildrenOf = get_the_ID(); 
        }
        wp_list_pages(array(
          'title_li' => NULL,
          'child_of' => $findChildrenOf,
          'sort_column' => 'menu_order' //ordenação de acordo com o menu order do painel
        ));
          ?>
        </ul>
      </div>
      <div class="col-12 col-lg-9">
    <?php } else { ?>
      <div class="col-12">
    <?php } ?>
      <div>
        <div class="row">
          <div class="col-12">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>

  <?php }
  get_footer();
?>