<footer class="content-info bg-slate-700 text-white py-20">
	{{-- No jpg image support in blade icon --}}
	{{-- <x-icon-lorem /> --}}
	<div class="container mx-auto">
		
		<div class="grid-cols-4	grid gap-5">
			<div class="footer-widgets">
				{{-- <img src="@asset('images/icons/lorem.jpg')"> --}}
				<div class="logo">
					@svg('logo')
				</div>
				@php(dynamic_sidebar('sidebar-footer'))
			</div>
			<div class="footer-menu">
				@if (has_nav_menu('footer_navigation_1'))
				<div class="" aria-label="{{ wp_get_nav_menu_name('footer_navigation_1') }}">
					<p class="text-2xl mb-4">{!! wp_get_nav_menu_name('footer_navigation_1') !!}<p>
					{!! wp_nav_menu([
						'theme_location' => 'footer_navigation_1', 
						'menu_class' => 'nav nav-primary flex flex-col gap-2 no-underline', 
						'echo' => false
					]) !!}
				</div>
				@endif
			</div>
			<div class="footer-menu">
				@if (has_nav_menu('footer_navigation_2'))
				<div class="" aria-label="{{ wp_get_nav_menu_name('footer_navigation_2') }}">
					<p class="text-2xl mb-4">{!! wp_get_nav_menu_name('footer_navigation_2') !!}<p>
					{!! wp_nav_menu([
						'theme_location' => 'footer_navigation_2', 
						'menu_class' => 'nav nav-primary flex flex-col gap-2 no-underline', 
						'echo' => false
					]) !!}
				</div>
				@endif
			</div>
			<div class="footer-menu">
				@if (has_nav_menu('footer_navigation_3'))
				<p class="text-2xl mb-4">{!! wp_get_nav_menu_name('footer_navigation_3') !!}<p>
				<div class="" aria-label="{{ wp_get_nav_menu_name('footer_navigation_3') }}">
					{!! wp_nav_menu([
						'theme_location' => 'footer_navigation_3', 
						'menu_class' => 'nav nav-primary flex flex-col gap-2 no-underline', 
						'echo' => false
					]) !!}
				</div>
				@endif
			</div>
		</div>

	</div>
</footer>
