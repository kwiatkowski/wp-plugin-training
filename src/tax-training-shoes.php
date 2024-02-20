<?php

if (!function_exists('tax_training_shoes')):
    function tax_training_shoes() {

        $labels = array(
            'name'              => _x( 'Buty', 'taxonomy general name', PLUGIN_NAME ),
            'singular_name'     => _x( 'But', 'taxonomy singular name', PLUGIN_NAME ),
            'search_items'      => __( 'Szukaj buta', PLUGIN_NAME ),
            'all_items'         => __( 'Wszystkie', PLUGIN_NAME ),
            'parent_item'       => __( 'Nadrzędny', PLUGIN_NAME ),
            'parent_item_colon' => __( 'Nadrzędny:', PLUGIN_NAME ),
            'edit_item'         => __( 'Edytuj', PLUGIN_NAME ),
            'update_item'       => __( 'Aktualizuj', PLUGIN_NAME ),
            'add_new_item'      => __( 'Dodaj nowy but', PLUGIN_NAME ),
            'new_item_name'     => __( 'Nowy', PLUGIN_NAME ),
            'menu_name'         => __( 'Buty', PLUGIN_NAME ),
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_in_rest'      => true, // /wp-json/wp/v2/training_shoes
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => false,
            'meta_box_cb'       => false,
            'query_var'         => true,
            'rewrite'           => array(
                'slug' => 'shoe',
                'with_front' => false
            ),

        );

        register_taxonomy('training_shoes', array('training'), $args);
    }
endif;

add_action('init', 'tax_training_shoes', 0);
