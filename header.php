<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="author" content="Luan Gjokaj, and WordPressify contributors"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php wp_head(); ?>
</head>
<style>
    :root {
    <?php if (is_front_page()){ ?>
        --color_header: #fff;
        --register_login: #fff;
    <?php }else{ ?>
        --color_header: #0078C1;
        --register_login: #fcfcfc;
    <?php }?>
    }

    }
</style>
<body <?php body_class(); ?>>
<?php get_template_part("template-parts/header") ?>
