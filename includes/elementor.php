<?php
function get__artists_by_genre($genre)
{
    $recordings = get_posts(array(
        'post_type' => 'recordings',
        'fields' => 'ids',
        'tax_query' => array(
            array(
                'taxonomy' => 'genres',
                'field' => 'slug',
                'terms' => 'alternative',
            ),
        ),
    ));

    $artists_arr = [];
    foreach ($recordings as $recording) {
        $artists = get_the_terms($recording, 'artists');
        foreach ($artists as $artist) {
            $artists_arr[] = $artist->slug;
        }
    }
    return $artists_arr;
}
function my_query_by_post_types($query)
{
    $query->set('post_type', ['custom-post-type1', 'custom-post-type2']);
}
add_action('elementor/query/query_genre_alternatives', 'my_query_by_post_types');
