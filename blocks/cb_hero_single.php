<?php
/**
 * Block template for CB Hero.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$bg = wp_get_attachment_image_url( get_field('image') ,'full');
?>
<div class="hero mb-5">
	<img src="<?=$bg?>" class="hero__image">
	<div class="overlay"></div>
	<div class="content">
		<div class="hero-single__grid hero__grid">
		    <div class="hero-single__content bg-dark bg-opacity-75">
		        <div class="hero-single__content--inner">
		            <h1 class="mb-4"><?=get_field('title')?></h1>
		            <div><?=get_field('content')?></div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="hero-swoop"></div>
</div>