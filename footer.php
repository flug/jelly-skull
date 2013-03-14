</div>
</div>
</div>
<footer class="container footer">


	<div class="row">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer') ) : ?>
			<!-- Partie qui s'affichera uniquement si les Widgets ne sont pas disponibles -->
			<!-- Mais qui affichera les Widgets si ils sont disponibles -->
		<?php endif; ?>
	</ul>
	<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>