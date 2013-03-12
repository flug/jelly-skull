<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
<?php endwhile; ?>
<?php else : ?>

<?php endif; // end have_posts() check ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>