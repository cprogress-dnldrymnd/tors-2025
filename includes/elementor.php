<?php
function get__artists_by_genre($genre)
{
    $recordings = get_posts(array(
        'post_type' => 'recordings',
        'fields' => 'ids',
        'numberposts' => -1,
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
            $artists_arr[] = array(
                'term_id' => $artist->term_id,
                'slug' => $artist->slug,
                'name' => $artist->name,
            );
        }
    }
    return array_unique($artists_arr);
}
function query_genre_alternatives($query)
{
    $artists = get__artists_by_genre('alternative');
    $query->set('taxonomy', 'artists');
}
add_action('elementor/query/query_genre_alternatives', 'query_genre_alternatives');
