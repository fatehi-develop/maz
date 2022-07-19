<?php
$list_categories = get_sub_field("list_categories");
?>
<?php if (isset($list_categories) && !empty($list_categories)){ ?>
<div>
    <div class="container container--1300">
        <div class="list_categoris mb-80">
            <?php foreach ($list_categories as $item){ ?>
            <div class="item_categoris">
                <a href="<?= get_term_link($item["cat"]) ?>" class="item_categoris__img">
                    <img src="<?= @$item["pic"]["url"] ?>" alt="">
                </a>
                <a href="<?= get_term_link($item["cat"]) ?>" class="item_categoris__title pf-1"><?= @$item["title"] ?></a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php }  ?>