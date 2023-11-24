<?php

add_theme_support('title-tag'); // support de mon title tag
add_theme_support('post-thumbnails'); // support du thumbnail sur mes articles
add_theme_support('menus'); // support des menus WordPress

function wpbootstrap_styles_scripts() {
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');
  wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', ['bootstrap'], '1.0.0', 'all');

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js', false, '1.0.0', true);
  wp_enqueue_script('scripts', get_template_directory_uri().'/js/script.js', ['jquery'], '1.0.0', true);}

add_action('wp_enqueue_scripts', 'wpbootstrap_styles_scripts');

function my_admin_menu() {
	add_menu_page(
		'Header hero', // nom de mon menu
		'Header hero', // nom affiché dans la sidebar de l'admin wordpress
		'manage_options', // la capacité requise pour que ce menu soit affiché à l'utilisateur.
		'sample-page', // le slug (donc l'url dans l'admin)
		'my_admin_page__header_hero__contents', // notre function qui va construire la page
		'dashicons-schedule', // l'icone dans la side bar
		3
	);
}
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_page__header_hero__contents() {
  // ici je vérifie que que le contenu a bien été modifier 
  // si ce n'est pas le cas.. pas besoin d'enregistrer
  if( $_POST['updated'] === 'true' ){ 

    // si mon contenu a bien été enregistré je vérifie que mon fomulaire existe bien
    if( ! isset( $_POST['header-hero_form'] ) || ! wp_verify_nonce( $_POST['header-hero_form'], 'header-hero_update' ) ){ 
      // si ce n'est pas le cas je retourne une erreur  
    ?>
      <div class="error">
        <p>Sorry, your nonce was not correct. Please try again.</p>
      </div> <?php
      exit;
    } else {
      // si toute les vérifications se sont bien passée j'enregistre mes données

      // 
      // dans cette section je vais simplement récupérer les champs de mon formulaire 
      // "main-title", "under-title", "scroll-label", "background-url"
      // et demander a worpress de les traiter.. en suite j'enregistre ça dans une variable pour chaque champs
      // 
      $mainTitle = sanitize_text_field( $_POST['main-title'] ); 
      $underTitle = sanitize_text_field( $_POST['under-title'] );
      $scrollLabel = sanitize_text_field( $_POST['scroll-label'] );
      $backgroundUrl = sanitize_text_field( $_POST['background-url'] );
      //
      
      // 
      // dans cette section je récupère les variable que j'ai enregistré avant 
      // et je les stock dans une "option" wordpress option que je pourrais récupérer plus tard en fonction de mes besoin
      // avec "get_option" suivi du nom de mon options
      //
      // donc pour enregistrer l'option j'utilise "update_option" pour la récuperer j'utilise "get_option"
      // 
      update_option('header-hero_main-title', $mainTitle );
      update_option('header-hero_under-title', $underTitle );
      update_option('header-hero_scroll-label', $scrollLabel );
      update_option('header-hero_background-url', $backgroundUrl );
      //
    }
  } ?>
  <div class="wrap">
    <h2><?php
      // je récupère le titre de ma page admin dans mon cas "Header hero"
      // c'est la 2eme ligne de "add_menu_page()"
      echo get_admin_page_title();
    ?></h2>
    <form method="POST">
      <input type="hidden" name="updated" value="true" />
      <?php 
        // ici je j'ajoute mon "vérificateur" en utilisant la function "wp_nonce_field" qui permet de nomer mon formulaire
        // c'est grace a lui que je pourrais vérifier l'existance de mon formulaire d'ajout de données
        wp_nonce_field( 'header-hero_update', 'header-hero_form' ); 
      ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th><label for="main-title">Main title</label></th>
            <td><input name="main-title" id="main-title" type="text" value="<?php echo get_option('header-hero_main-title'); ?>" class="regular-text" /></td>
          </tr>
          <tr>
            <th><label for="under-title">Under title</label></th>
            <td><input name="under-title" id="under-title" type="text" value="<?php echo get_option('header-hero_under-title'); ?>" class="regular-text" /></td>
          </tr>
          <tr>
            <th><label for="scroll-label">Scroll label</label></th>
            <td><input name="scroll-label" id="scroll-label" type="text" value="<?php echo get_option('header-hero_scroll-label'); ?>" class="regular-text" /></td>
          </tr>
          <tr>
            <th><label for="background-url">Background image url</label></th>
            <td><input name="background-url" id="background-url" type="text" value="<?php echo get_option('header-hero_background-url'); ?>" class="regular-text" /></td>
          </tr>
        </tbody>
      </table>
      <p class="submit">
        <?php
          // wordpress nous donne la possibilité de générer un bouton pour enregistrer les valeurs de notre formulaire
          submit_button(); 
        ?></p>
    </form>
  </div>
  <?php 
}function create_post_type() {	 // function dans la quel j'ajouterais tous mes type de contenu
	register_post_type('services'/* le nom de mon type de contenu */, [ // tableau avec mes options 
		'labels' => [ // ça sera le nom afficher dans mon menu word press avec la traduction
			'name' => __('Services'), // __() permet a wordpress que c'est contenu de traduction
			'singular_name' => __('Services')
		],
    'supports' => ['title', 'editor', 'thumbnail'], // on precise que notre post_type support title(un titre), editor(l'éditeur de contenu) et thumbnail(une photo a la une)
		'public' => true, // c'est un post_type publique
		'has_archive' => false, // en cas de suppression on peut retrouver notre post disparu
  	'rewrite' => ['slug' => 'services'], // j'applique une réécriture d'url "services" au lieu de "slug"
		'menu_icon' => 'dashicons-clipboard' // je lui précise une icon dans la bar d'outil de l'admin wordpress
	]);
}
add_action('init', 'create_post_type');

