<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package
 */

get_header(); ?>

<?php

    while ( have_posts() ) : the_post();

        /*if (get_post_type()=="portfolio"):
            get_template_part( 'template-parts/single/single', 'portfolio' );
        elseif (get_post_type()=="soluzioni"):
            get_template_part( 'template-parts/single/single', 'soluzioni' );
        elseif (get_post_type()=="servizi"):
            get_template_part( 'template-parts/single/single', 'servizi' );
        else:
            get_template_part( 'template-parts/content/content', get_post_format() );
        endif;*/

    endwhile; // End of the loop.

?>

<?php get_footer();