<aside class="four columns">
	<nav>
		<ul class="sidebar-nav">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-lateral') ) : ?>
			<!-- Partie qui s'affichera uniquement si les Widgets ne sont pas disponibles -->
			<!-- Mais qui affichera les Widgets si ils sont disponibles -->
		<?php endif; ?>
		<ul>
	</nav>
</aside>