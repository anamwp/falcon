<?php
/**
 * Theme Service Provider
 * app/Providers — The place for any Service Providers you care to define for your theme. Comes
 * with ThemeServiceProvider that adds no functionality but provides a template for your own
 * Service Providers.
 *
 * @package Falcon
 */

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider {

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		parent::register();
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		parent::boot();
	}
}
