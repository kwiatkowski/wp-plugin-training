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
            'hierarchical'      => false,
            'public'            => false,
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

// Usunięcie pola Opis z formularza dodawania nowej taksonomii
function remove_description_field_for_training_shoes_add($taxonomy) {
    if ($taxonomy === 'training_shoes') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('textarea#tag-description').closest('.form-field').remove();
            });
        </script>
        <?php
    }
}
add_action('training_shoes_add_form_fields', 'remove_description_field_for_training_shoes_add');

// Usunięcie pola Opis z formularza edycji taksonomii
function remove_description_field_for_training_shoes_edit($term, $taxonomy) {
    if ($taxonomy === 'training_shoes') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('tr.form-field.term-description-wrap').remove();
            });
        </script>
        <?php
    }
}
add_action('training_shoes_edit_form_fields', 'remove_description_field_for_training_shoes_edit', 10, 2);

// Usunięcie kolumny Opis z tabeli termów
function remove_description_column_from_training_shoes($columns) {
    if (isset($columns['description'])) {
        unset($columns['description']);
    }
    return $columns;
}
add_filter('manage_edit-training_shoes_columns', 'remove_description_column_from_training_shoes');