<?php
get_header();
?>
<main id="main" class="site-main ">
    <div class="container">
        <article>
            <div class="title-part inner-title text-center">
                <h1 class="title-heading"><?php echo get_the_title();?></h1>
            </div>
            <?php if (has_post_thumbnail()) { ?>
                <div class="simple-thumbnail-img my-3 mb-md-5">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php } ?>
            <div class="editor-content <?php if( !is_account_page()  && !is_page( 'cart' ) && !is_cart() && !is_checkout()  ) { echo 'main-content'; } ?>"><?php the_content();?></div>
        </article>
    </div>





</main>
<?php get_footer(); ?>
