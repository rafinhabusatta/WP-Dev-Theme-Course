<?php

if (!is_user_logged_in()) {
  wp_redirect(esc_url(site_url('/')));
  exit;
}

get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
  ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <h2>Create a note</h2>
          <input type="text" placeholder="Title" class="form-control mb-3 create-title">
          <textarea class="form-control mb-3 create-body" placeholder="Your note here..."></textarea>
          <span class="btn btn-success create-note">Create note</span>
        </div>
      </div>
      <ul id="myNotes">
      <?php 
        $userNotes = new WP_Query(array(
          'post_type' => 'note',
          'posts_per_page' => -1,
          'author' => get_current_user_id()
        ));

        while($userNotes->have_posts()) {
          $userNotes->the_post(); ?>
          <li data-id="<?php the_ID(); ?>" class="note-item">
            <input class="note-title form-control-plaintext" readonly value="<?php echo esc_attr(get_the_title()); ?>">
            <div class="mt-3">
              <span class="btn btn-success edit-note">Edit</span>
              <span class="btn btn-danger delete-note">Delete</span>
            </div>
            <textarea class="note-body form-control-plaintext mt-3 resize-none" readonly name="" id=""><?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?></textarea>
            <span class="btn btn-success update-note d-none mt-3">Save</span>
          </li>
       <?php }
      ?>
      </ul>
    </div>
  </div>
</div>
<?php get_footer(); ?>

  <?php }
  get_footer();
?>