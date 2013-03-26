<?php get_header(); ?>
<?php	/* This variable is for alternating comment background */
$oddcomment = ' alt';
?>

<div class="row">

	<?php get_sidebar(); ?>
	<?php if (have_posts()) : ?>

	<div class="post-top" id="post-<?php the_ID(); ?>">


		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2> <?php single_cat_title(); ?>  </h2>

		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2> <?php the_time('j F, Y'); ?> </h2>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2> <?php the_time('F, Y'); ?> </h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2> <?php the_time('Y'); ?> </h2>

		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2>Archives par Auteur</h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2>Archives du Blog</h2>

		<?php } ?>

		<div class="entry">

			<?php while (have_posts()) : the_post(); ?>
			<aside class="eight columns ">
				<div class="result<?php echo $oddcomment; ?>" >
					<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Lien Permanent vers <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<small><span class="bold">Sujets:</span> <?php the_category(', ') ?></small>

					<div class="entry">
						<?php the_content() ?>
					</div>

					<p class="postmetadata"><?php edit_post_link('Editer', '', ' '); ?></p>

				</div>
				<?php
				/* Changes every other comment to a different class */
				$oddcomment = ( empty( $oddcomment ) ) ? ' alt' : '';
				?>
			</aside>
		<?php endwhile; ?>

	<?php else : ?>

	<div class="post-top" id="post-<?php the_ID(); ?>">
		<div class="post-bottom">
			<div class="post-middle">
				<div class="post">
					<h2>Archive non Trouvée.</h2>
					<div class="entry">



					<?php endif; ?>

				</div>

			</div>
		</div>


		<?php get_footer(); ?>