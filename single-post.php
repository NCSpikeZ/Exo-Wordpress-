<?php get_header(); ?>

<main>
  <section class="container single-news">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <div class="entry-meta">
            <span class="posted-on"><?php echo get_the_date(); ?></span>
          </div>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </section>
</main>

<?php get_footer(); ?>
