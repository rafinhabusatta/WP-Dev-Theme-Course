<div class="container">
  <div class="row">
    <div class="col-6 mx-auto">
      <form method="get" action="<?php echo esc_url(site_url('/')); ?>">
        <label for="s" class="form-label mb-3">Faça uma nova busca</label>
        <input placeholder="O que você está procurando?" class="form-control mb-3" id="s" type="search" name="s">
        <input class="btn btn-primary" type="submit" value="Search">
      </form>
    </div>
  </div>
</div>