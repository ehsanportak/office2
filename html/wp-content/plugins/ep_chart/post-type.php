<?php
//custom post types 

//post type hotels
add_action( 'init', 'ep_chart_custom_post_type' );
function ep_chart_custom_post_type(){

    $labels = array( 
        'name'               => 'چارت',
        'singular_name'      =>  'چارت',
        'menu_name'          =>  'چارت ها',
        'name_admin_bar'     => 'چارت',
        'add_new'            => 'چارت جدید',
        'add_new_item'       => 'آیتم چارت جدید',
        'new_item'           => 'چارت جدید',
        'edit_item'          => 'ویرایش چارت',
        'view_item'          => 'نمایش چارت',
        'all_items'          => 'تمام چارت ها',
        'search_items'       => 'جستجوی چارت ها',
        'parent_item_colon'  => 'چارت ها مادر :',
        'not_found'          => 'چارتی یافت نشد',
        'not_found_in_trash' =>'چارت در زباله دان یافت نشد'
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'مطالب چارت قالب',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'chart','with_fornt'=>true),
        'capability_type'    => 'post',
        'menu_icon'          => 'dashicons-admin-home',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         =>array('post_tag','category'),
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
    register_post_type( 'chart', $args );
}