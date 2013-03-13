<?php get_header(); ?>

 

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<h3>Posté le <?php the_time('j F, Y') ?> dans <?php the_category(', ') ?> <?php edit_post_link('Editer', ' | ', ''); ?>  <?php comments_popup_link('Aucun Commentaire &#187;', '1 Commentaire &#187;', '% Commentaires &#187;'); ?></h3>
			

		
				<?php the_content('Lire la Suite &raquo;'); ?>
		

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		

		<?php endwhile; endif; ?>
	<?php edit_post_link('Editer cet Article.', '<p>', '</p>'); ?>
	
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>