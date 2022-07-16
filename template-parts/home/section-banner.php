<?php
$items = get_sub_field('items');
$layout = str_replace('.png', '', end(explode('/', get_sub_field('layout'))));
?>
<?php if ($items) { ?>
    <div class="section-banners m-120">
        <div class="container container--1300">
            <div class="row p30">
                <?php
                if ($items != null) {
                    switch ($layout) {
                        case 'full' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12 mb-4';
                                websima_banner_show($item,$col);
                            }
                            break;
                        case 'half-half' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 4) break;
                            }
                            break;
                        case 'third' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-4 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 3) break;
                            }
                            break;
                        case 'third-2' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-3 mb-4';
                                if ($i == 2 || $i == 5) $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 3) break;
                            }
                            break;
                        case 'zigzag' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12 mb-4';
                                if ($i == 1 || $i == 4) $col = 'col-sm-8 mb-4';
                                if ($i == 2 || $i == 3) $col = 'col-sm-4 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 4) break;
                            }
                            break;
                        case 'third-half' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12 mb-4';
                                if ($i == 1 || $i == 2) $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 3) break;
                            }
                            break;
                        case 'ver-third' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12 mb-4';
                                if ($i == 3 || $i == 2) $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 3) break;
                            }
                            break;
                        case 'five' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-4 mb-4';
                                if ($i == 1 || $i == 2) $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                            }
                            break;
                        case 'four-v-1' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-4 mb-4';
                                echo "<div class='" . $col . "'>";
                                echo "<a href='" . $item['url'] . "'>";
                                echo wp_get_attachment_image($item['image'], 'full');
                                echo "</a>";
                                echo "</div>";
                                if ($i == 1) break;
                            }

                            $i = 0;
                            echo "<div class='col-sm-8'>";
                            echo "<div class='row'>";
                            foreach ($items as $item) {
                                $i++;
                                if ($i == 1) continue;
                                $col = 'col-sm-6 mb-4';
                                if ($i == 4) $col = 'col-12 mb-4';
                                echo "<div class='" . $col . "'>";
                                echo "<a href='" . $item['url'] . "'>";
                                echo wp_get_attachment_image($item['image'], 'full');
                                echo "</a>";
                                echo "</div>";
                                if ($i == 4) break;
                            }
                            echo "</div>";
                            echo "</div>";
                            break;
                        case 'four-v-2' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-sm-4 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 1) break;
                            }
                            $i = 0;
                            echo "<div class='col-sm-8'>";
                            echo "<div class='row'>";
                            foreach ($items as $item) {
                                $i++;
                                if ($i == 1) continue;
                                $col = 'col-sm-6 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 5) break;
                            }
                            echo "</div>";
                            echo "</div>";
                            break;
                        case 'unfair' :
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12 mb-4';
                                if ($i == 2) $col = 'col-sm-6 mb-4';
                                if ($i == 3 || $i == 4) $col = 'col-sm-3 mb-4';
                                websima_banner_show($item,$col);
                                if ($i == 4) break;
                            }
                            break;
                        case 'tow-one' :
                            $i = 0;
                            echo "<div class='col-sm-5'>";
                            echo "<div class='row p30'>";
                            foreach ($items as $item) {
                                $i++;
                                $col = 'col-12';
                                websima_banner_show($item, $col);
                                if ($i == 2) break;
                            }
                            echo "</div>";
                            echo "</div>";
                            $i = 0;
                            foreach ($items as $item) {
                                $i++;
                                if ($i < 3) continue;
                                $col = 'col-sm-7';
                                websima_banner_show($item, $col);
                                if ($i == 3) break;
                            }
                            break;

                    }
                } ?>
            </div>
        </div>
    </div>

<?php } ?>