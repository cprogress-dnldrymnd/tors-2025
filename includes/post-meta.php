<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;


/*-----------------------------------------------------------------------------------*/
/* Get a Quote
/*-----------------------------------------------------------------------------------*/
/*
Container::make('theme_options', __('Get a Quote Form'))
  ->add_fields(
    array(
      Field::make('complex', 'get_a_quote_form', __(''))
        ->add_fields(
          array(
            Field::make('text', 'name', __('Name')),
            Field::make('image', 'image', __('Image')),
          )
        )
        ->set_layout('tabbed-vertical')
        ->set_header_template('<%- name  %>'),

    )
  );*/

/*-----------------------------------------------------------------------------------*/
/* Recordings
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', 'Audio')
  ->where('post_type', '=', 'recordings')
  ->add_fields(
    array(
      Field::make('file', 'before_audio', __('Before Audio'))->set_width(20)
        ->set_type(array('audio')),
      Field::make('file', 'after_audio', __('After Audio'))->set_width(80)
        ->set_type(array('audio')),
    )
  );

/*-----------------------------------------------------------------------------------*/
/* Blogs
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Audio')
  ->where('post_type', '=', 'post')
  ->add_fields(
    array(
      Field::make('text', 'read_time', __('Read Time'))
    )
  );



Container::make('term_meta', __('Artists Properties'))
  ->where('term_taxonomy', '=', 'category')
  ->add_fields(array(
    Field::make('image', 'image', __('Image')),
  ));
