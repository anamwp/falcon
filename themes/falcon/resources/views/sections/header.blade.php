<header class="site__header banner bg-slate-700 text-white py-5">
	<div class="container site__header__container mx-auto flex justify-between">
		<a class="font-bold brand site__brand uppercase text-2xl no-underline" href="{{ home_url('/') }}">
		{!! $siteName !!}
		</a>

		@if (has_nav_menu('primary_navigation'))
		<nav class="site__navigation sage-head-nav nav-primary flex" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
			{!! wp_nav_menu([
				'theme_location' => 'primary_navigation', 
				'menu_class' => 'nav flex gap-2 no-underline', 
				'echo' => false
			]) !!}
		</nav>
		@endif
	</div>
</header>
