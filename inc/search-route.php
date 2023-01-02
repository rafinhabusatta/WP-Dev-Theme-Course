<?php 

function aladvogadosRegisterSearch() {
  register_rest_route('aladvogados/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // GET request (crud)
    'callback' => 'aladvogadosSearchResults'
  )); // namespace, route, array of options
}
add_action('rest_api_init', 'aladvogadosRegisterSearch');

function aladvogadosSearchResults() {
  $professors = new WP_QUERY(array(
    'post_type' => 'professor'
  ));

  $professorResults = array();

  while($professors->have_posts()) {
    $professors->the_post();
    array_push($professorResults, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink()
    
    ));
  }
  
  return $professorResults;
}