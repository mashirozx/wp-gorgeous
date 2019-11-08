<?php 
/**
* Index post thumb list item
*/

switch ( get_post_meta(get_the_ID(), 'thumb-colorway', true) )
{
case 'light':
  get_template_part( 'layout/tpl/thumb', 'light' );
  break;  
case 'dark':
  get_template_part( 'layout/tpl/thumb', 'dark' );
  break;
default:
  get_template_part( 'layout/tpl/thumb', 'light' );
}