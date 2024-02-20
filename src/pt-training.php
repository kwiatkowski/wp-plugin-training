<?php

if (!function_exists('pt_training')):
    function pt_training() {
        $labels = array(
            'name'                  => _x('Treningi', 'Post type general name', TRAINING_NAME),
            'singular_name'         => _x('Trening', 'Post type singular name', TRAINING_NAME),
            'menu_name'             => _x('Treningi', 'Admin Menu text', TRAINING_NAME),
            'parent_item_colon'     => __('Nadrzędny:', TRAINING_NAME),
            'all_items'             => __('Wszystkie treningi', TRAINING_NAME),
            'view_item'             => __('Zobacz', TRAINING_NAME),
            'add_new_item'          => __('Dodaj nowy', TRAINING_NAME),
            'add_new'               => __('Dodaj nowy', TRAINING_NAME),
            'edit_item'             => __('Edytuj', TRAINING_NAME),
            'update_item'           => __('Aktualizuj', TRAINING_NAME),
            'search_items'          => __('Szukaj', TRAINING_NAME),
            'not_found'             => __('Nie odnaleziono', TRAINING_NAME),
            'not_found_in_trash'    => __('Nie odnaleziono', TRAINING_NAME),
        );

        $args = array(
            'label'                 => __('Trening', TRAINING_NAME),
            'description'           => __('Trening', TRAINING_NAME),
            'labels'                => $labels,
            'supports'              => array('title'),
            'taxonomies'            => array('training-shoes'),
            'hierarchical'          => false,
            'public'                => false,
            'show_in_rest'          => true, // /wp-json/wp/v2/training
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-universal-access',
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'page',
            'rewrite'               => array(
                'slug' => 'training',
                'with_front' => true
            ),
        );

        register_post_type('training', $args);
    }
endif;

add_action('init', 'pt_training');



/**
 * training_big_json_change_post_per_page
 *
 * per_page max
**/

function training_big_json_change_post_per_page( $params ) {
    if ( isset( $params['per_page'] ) ) {
        $params['per_page']['maximum'] = 99999;
    }

    return $params;
}

add_filter('rest_training_collection_params', 'training_big_json_change_post_per_page', 10, 1);



/**
 * training_filter_posts_columns
 *
 * Customize the column headers displayed in the "training" list view
**/

function training_filter_posts_columns( $columns ) {
    unset($columns['title']);
    // unset($columns['date']);
    // unset($columns['taxonomy-destiny']);
    $columns['type'] = __('Typ', PLUGIN_NAME);
    $columns['distance'] = __('Dystans', PLUGIN_NAME);
    $columns['duration'] = __('Czas trwania', PLUGIN_NAME);
    $columns['stride_length'] = __('Długość kroku', PLUGIN_NAME);
    $columns['average_heart_rate'] = __('Średnie tętno', PLUGIN_NAME);
    $columns['v02max'] = __('V02Max', PLUGIN_NAME);

    return $columns;
}

add_filter('manage_training_posts_columns', 'training_filter_posts_columns');



/**
 * training_custom_column
 *
 * Customize the columns displayed in the "training" list view
**/

function training_custom_column( $column, $post_id ) {
    switch ($column) {
        case 'type':
            switch (get_field('type', $post_id)) {
                case 'calm':
                    echo 'Spokojny';
                    break;
                case 'running_around':
                    echo 'Rozbieganie';
                    break;
                case 'verification':
                    echo 'Sprawdzenie';
                    break;
                case 'competition':
                    echo 'Zawody';
                    break;
            }
            break;

        case 'distance':
            echo get_field('distance', $post_id) . ' m';
            break;

        case 'duration':
            echo get_field('duration', $post_id);
            break;

        case 'stride_length':
            echo get_field('stride_length', $post_id) . ' cm';
            break;

        case 'average_heart_rate':
            echo get_field('average_heart_rate', $post_id);
            break;

        case 'v02max':
            echo get_field('v02max', $post_id);
            break;
    }
}

add_action ('manage_training_posts_custom_column', 'training_custom_column', 10, 2);



/**
 * training_custom_column
 *
 * Hide quick edit
**/

function training_remove_quick_edit( $actions, $post ) {
    // Sprawdzamy, czy wpis należy do niestandardowego typu 'training'
    if ($post->post_type === 'training') {
        // unset($actions['edit']);
        // unset($actions['trash']);
        // unset($actions['view']);
        unset($actions['inline hide-if-no-js']);
    }
    return $actions;
}
add_filter('post_row_actions', 'training_remove_quick_edit', 10, 2);
