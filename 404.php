<?php get_header(); ?>
    <main>
        <section style="text-align: center;">

            <div style="margin: 0 auto; width: 60%; text-align: left;">
                <?php
                $image_url = 'http://localhost/test-wordpress/wp-content/uploads/2023/11/404-1.png';
                ?>

                <p style="text-align: center;"><img src="<?php echo esc_url($image_url); ?>" alt="Erreur 404" style="margin-top: 100px;" /></p>

                <p>Nous sommes désolés, mais la page que vous cherchez n'est pas ou plus disponible. Nous vous suggérons de vous rendre sur <a href="<?php echo esc_url(home_url('/')); ?>">la page d'accueil</a> du site ou d'effectuer une nouvelle recherche :</p>

                <p>Découvrez nos derniers articles :</p>

                <?php
                $args = array(
                    'posts_per_page' => 5
                );
                $my_query = new WP_Query($args);
                while ($my_query->have_posts()) : $my_query->the_post();
                ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <?php
                endwhile;
                wp_reset_postdata(); // Réinitialiser les données de la requête
                ?>

            </div>
        </section>
    </main>

<?php get_footer(); ?>
