<?php get_header(); ?>
<main>
  <section class="container section single-service">
    <?php
    if (have_posts()) :
      while (have_posts()) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header>
            <h2 class="text-center mb-3"><?php the_title(); ?></h2>
          </header>
          <div class="row">
            <div class="col-md-6">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid" alt="<?php the_title(); ?>">
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <p class="card-text"><?php the_content(); ?></p>
                </div>
              </div>
            </div>
          </div>
        </article>
    <?php
      endwhile;
    else :
    ?>
      <p>Aucun contenu trouvé</p>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>
