<?php
$posts_in = array();
$next_post = get_next_post();
$previous_post = get_previous_post();
?>
<section class="casenav all_projects py-5">
    <div class="container-xl">
        <div class="h1 fs-1 wp-block-heading has-text-align-center mb-4">More Projects</div>
        <div class="all_projects__grid">
            <?php
            if ($previous_post) :
                $img = get_the_post_thumbnail_url($previous_post->ID);
                if (!$img ) {
                    $content_post = get_post($previous_post->ID);
                    $content = $content_post->post_content;
                    foreach ( parse_blocks( $content ) as $b ) {
                        if($b['blockName'] == 'acf/cb-hero') {
                            $img = $b['attrs']['data']['images_0_image'];
                            $img = wp_get_attachment_image_url($img,'large');
                        }
                    }
                }
                ?>
                <a class="all_projects__card" href="<?=get_the_permalink($previous_post->ID)?>">
                    <img src="<?=$img?>" alt="<?=get_the_title($previous_post->ID)?>">
                    <h2 class="fs-4"><?=get_the_title($previous_post->ID)?></h2>
                </a>
                <?php
            else :
                $q = new WP_Query(array(
                    'post_type' => 'projects',
                    'posts_per_page' => 1,
                    'order' => 'DESC'
                ));
                while($q->have_posts()) {
                    $q->the_post();
                    $img = get_the_post_thumbnail_url();
                    if (!$img ) {
                        foreach ( parse_blocks( get_the_content() ) as $b ) {
                            if($b['blockName'] == 'acf/cb-hero') {
                                $img = $b['attrs']['data']['images_0_image'];
                                $img = wp_get_attachment_image_url($img,'large');
                            }
                        }
                    }
                    ?>
                    <a class="all_projects__card" href="<?=get_the_permalink()?>">
                        <img src="<?=$img?>" alt="">
                        <h2 class="fs-4"><?=get_the_title()?></h2>
                    </a>
                    <?php
                }
            endif;
            ?>
            <?php
            if ($next_post) :
                $img = get_the_post_thumbnail_url($next_post->ID);
                if (!$img ) {
                    $content_post = get_post($next_post->ID);
                    $content = $content_post->post_content;
                    foreach ( parse_blocks( $content ) as $b ) {
                        if($b['blockName'] == 'acf/cb-hero') {
                            $img = $b['attrs']['data']['images_0_image'];
                            $img = wp_get_attachment_image_url($img,'large');
                        }
                    }
                }
                ?>
                <a class="all_projects__card" href="<?=get_the_permalink($next_post->ID)?>">
                    <img src="<?=$img?>" alt="<?=get_the_title($next_post->ID)?>">
                    <h2 class="fs-4"><?=get_the_title($next_post->ID)?></h2>
                </a>
                <?php
            else :
                $q = new WP_Query(array(
                    'post_type' => 'projects',
                    'posts_per_page' => 1,
                    'order' => 'ASC'
                ));
                while($q->have_posts()) {
                    $q->the_post();
                    $img = get_the_post_thumbnail_url();
                    if (!$img ) {
                        foreach ( parse_blocks( get_the_content() ) as $b ) {
                            if($b['blockName'] == 'acf/cb-hero') {
                                $img = $b['attrs']['data']['images_0_image'];
                                $img = wp_get_attachment_image_url($img,'large');
                            }
                        }
                    }
                    ?>
                    <a class="all_projects__card" href="<?=get_the_permalink()?>">
                        <img src="<?=$img?>" alt="">
                        <h2 class="fs-4"><?=get_the_title()?></h2>
                    </a>
                    <?php
                }
            endif;
            ?>
        </div>
    </div>
</section>