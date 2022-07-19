<?php
/* template name: Home */
get_header();
?>
<?php
$layouts = array('best-sellers' , 'feature', 'categories', 'products', 'counter', 'content', 'blog', 'banner', 'brands', 'faq', 'cta', 'testimonial', 'hero', 'teams' , 'products-offer');
if (have_rows('home_layouts', get_queried_object_id())) :
    while (have_rows('home_layouts', get_queried_object_id())) : the_row();
        foreach ($layouts as $layout) {
            if ($layout == get_row_layout()) {
                get_template_part('template-parts/home/section', $layout);
            }
        }
    endwhile;
endif;
?>
<?php get_footer(); ?>