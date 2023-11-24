<?php
/*
Template Name: About Template
*/

get_header();

$about_page = get_page_by_title('about');

if ($about_page) {
    ?>
    <main>
        <section class="container section about" id="about">
            <div class="row align-items-center">
                <div class="col-md">
                    <header>
                        <h2 class="mb-3"><?php echo esc_html($about_page->post_title); ?></h2>
                    </header>
                    <div class="lead"><?php echo apply_filters('the_content', $about_page->post_content); ?></div>
                </div>
                <div class="col-md">
                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($about_page->ID, 'medium'); ?>" alt="cordonnier au travail">
                </div>
            </div>
        </section>
    </main>
    <?php
}

get_footer();
?>
