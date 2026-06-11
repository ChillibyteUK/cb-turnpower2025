<section class="all_projects py-5">
    <div class="container-xl">
        <div class="all_projects__grid">
        <?php
        $q = new WP_Query(array(
            'post_type' => 'projects',
            'posts_per_page' => -1
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
        ?>
        </div>
    </div>
</section>