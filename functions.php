

<?php

    function motaphoto_supports() {
        add_theme_support('menus');
    }

    function motaphoto_add_admin_pages() {
        add_menu_page(__('Paramètres du thème MotaPhoto', 'motaphoto'), __('MotaPhoto', 'motaphoto'), 'manage_options', 'motaphoto-settings', 'motaphoto_theme_settings', 'dashicons-admin-settings', 60); 
    }

    function motaphoto_theme_settings() {
        echo '<h1>'.esc_html( get_admin_page_title() ).'</h1>';
        echo '<form action="options.php" method="post" name="motaphoto_settings">';
        echo '<div>';
  
        settings_fields('motaphoto_settings_fields');
        do_settings_sections('motaphoto_settings_section');
        submit_button();

        echo '</div>';
        echo '</form>';
    }

    function motaphoto_settings_register() {
        register_setting('motaphoto_settings_fields', 'motaphoto_settings_fields', 'motaphoto_settings_fields_validate');
        add_settings_section('motaphoto_settings_section', __('Paramètres', 'motaphoto'), 'motaphoto_settings_section_introduction', 'motaphoto_settings_section');
        add_settings_field('motaphoto_settings_field_introduction', __('Introduction', 'motaphoto'), 'motaphoto_settings_field_introduction_output', 'motaphoto_settings_section', 'motaphoto_settings_section');
        add_settings_field('motaphoto_settings_field_phone_number', __('Numéro de téléphone', 'motaphoto'), 'motaphoto_settings_field_phone_number_output', 'motaphoto_settings_section', 'motaphoto_settings_section');
        add_settings_field('motaphoto_settings_field_email', __('Email', 'motaphoto'), 'motaphoto_settings_field_email_output', 'motaphoto_settings_section', 'motaphoto_settings_section');
    }

    function motaphoto_settings_section_introduction() {
      echo __('Paramètrez les différentes options de votre thème MotaPhoto.', 'motaphoto');
    }

    function motaphoto_settings_fields_validate($inputs) {  
      if(isset($_POST) && !empty($_POST)) {
        if(isset($_POST['motaphoto_settings_field_introduction']) && !empty($_POST['motaphoto_settings_field_introduction'])) {
          update_option('motaphoto_settings_field_introduction', $_POST['motaphoto_settings_field_introduction']);
        }
        if(isset($_POST['motaphoto_settings_field_phone_number']) && !empty($_POST['motaphoto_settings_field_phone_number'])) {
          update_option('motaphoto_settings_field_phone_number', $_POST['motaphoto_settings_field_phone_number']);
        }
        if(isset($_POST['motaphoto_settings_field_email']) && !empty($_POST['motaphoto_settings_field_email'])) {
          update_option('motaphoto_settings_field_email', $_POST['motaphoto_settings_field_email']);
        }
      }

      return $inputs;
    }

    function motaphoto_settings_field_introduction_output() {
      $value = get_option('motaphoto_settings_field_introduction');

      echo '<input name="motaphoto_settings_field_introduction" type="text" value="'.$value.'" />';
     }
     
     function motaphoto_settings_field_phone_number_output() {
      $value = get_option('motaphoto_settings_field_phone_number');

      echo '<input name="motaphoto_settings_field_phone_number" type="text" value="'.$value.'" />';
     }
     
    function motaphoto_settings_field_email_output() {
      $value = get_option('motaphoto_settings_field_email');

      echo '<input name="motaphoto_settings_field_email" type="text" value="'.$value.'" />';
    }

    function motaphoto_register_custom_post_types() {
			$labels_ingredient = array(
				'menu_name'             => __('Ingrédients', 'motaphoto'),
				'name_admin_bar'        => __('Ingrédient', 'motaphoto'),
	      'add_new_item'          => __('Ajouter un nouvel ingrédient', 'motaphoto'),
	      'new_item'              => __('Nouvel ingrédient', 'motaphoto'),
	      'edit_item'             => __('Modifier l\'ingrédient', 'motaphoto'),
			);

			$args_ingredient = array(
				'label'                 => __('Ingrédients', 'motaphoto'),
				'description'           => __('Ingrédients', 'motaphoto'),
				'labels'                => $labels_ingredient,
				'supports'              => array('title', 'thumbnail', 'excerpt', 'editor'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 40,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
				'menu_icon'   					=> 'dashicons-drumstick',
			);

			register_post_type('cif_ingredient', $args_ingredient);
		}

    /***** Actions *****/
    add_action('after_setup_theme', 'motaphoto_supports');
    add_action('admin_menu', 'motaphoto_add_admin_pages', 10);
    add_action('admin_init', 'motaphoto_settings_register');
    add_action('init', 'motaphoto_register_custom_post_types', 11);
?>