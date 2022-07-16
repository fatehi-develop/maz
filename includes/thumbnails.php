<?php
// Add featured image support
add_image_size('img_blog_index', 287, 231, true);
add_image_size('img_product_index', 120, 140, true);
add_image_size('img_banner', 684, 446, true);


function the_thumbnail($sizeof, $class = null, $postId = null, $echo = false)
{
    $img = null;
    if ($postId == null) {
        $postId = get_the_ID();
    }
    if (has_post_thumbnail($postId)) {
        $img = get_the_post_thumbnail($postId, $sizeof, array('class' => $class));
    } elseif ($sizeof == 'img_blog_index') {
        $img = '<img src="' . THEME_URL . 'img/img_blog_index-no-thumb.jpg" title="' . get_the_title() . '"  alt="' . get_the_title() . '""/>';
    } elseif ($sizeof == 'img_product_index') {
        $img = '<img src="' . THEME_URL . 'img/img_product_index-no-thumb.jpg" title="' . get_the_title() . '"  alt="' . get_the_title() . '""/>';
    } elseif ($sizeof == 'img_banner') {
        $img = '<img src="' . THEME_URL . 'img/img_banner-no-thumb.jpg" title="' . get_the_title() . '"  alt="' . get_the_title() . '""/>';
    }

    if ($echo) {
        echo $img;
    } else {
        return $img;
    }
}
