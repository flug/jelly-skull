<?php get_header(); ?>
<div class="row">
	<?php get_sidebar(); ?>
	<div class="eight columns">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php

		 if(!is_front_page()) : ?>
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>


	<?php endif; ?>
	



	<?php the_content('Lire la Suite &raquo;'); ?>


	<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>


<?php endwhile; endif; ?>
<?php edit_post_link('Editer cet Article.', '<p>', '</p>'); ?>

</div>

</div>
<?php get_footer(); ?>