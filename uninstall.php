<?php
/*
start on uninstall
@package: tambi-plugin
Notes: This file is used to clear db
*/

// first things first: security. i.e. check if user didnt accidentally click uninbstall

if(! defined('WP_UNINTSALL_PLUGIN')){
    die;
}

$books = get_posts(array('post_type'=>'book', 'numberposts'=>-1));

foreach ($books as $book)
{
    wp_delete_post($book->ID, true);
}

$books2 = get_posts(array('post_type'=>'book', 'numberposts'=>-1));

 


//  using mysql to delete everything at once
global $wpdb;
$wpdb->query("delete from wp_post where post_type='book'");
$wpdb->query("delete from wp_postmeta where post_id not in (select post_id from wp_post");
$wpdb->query("delete from wp_term_relationships where object_id not in(select post_id from wp_post");