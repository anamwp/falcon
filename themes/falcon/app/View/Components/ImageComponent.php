<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageComponent extends Component {

	public $imageId;
	public $imageUrl;
	public $imageSize;
	public $imageAltText;
	/**
	 * Create a new component instance.
	 */
	public function __construct( $imageId = '', $imageAltText = '', $imageSize = 'full' ) {
		$this->imageId      = $imageId;
		$this->imageSize    = $imageSize;
		$this->imageAltText = $imageAltText;
		$this->imageUrl     = $this->get_image_url( $this->imageId );
	}

	/**
	 * Handle image tag with srcset and sizes
	 *
	 * @param [type] $imageId
	 * @return void
	 */
	public function get_image_url( $imageId ) {
		$image_placeholder_url = @asset( 'images/placeholder.jpg' );
		if ( ! $imageId ) {
			return '<img src="' . $image_placeholder_url . '">';
		}
		/**
		 * If $imageId is not a number, return false
		 */
		if ( ! is_numeric( $imageId ) ) {
			return false;
		}
		/**
		 * Here are few more ways to get image url
		 * $image_src = wp_get_attachment_image_src($imageId, 'full');
		 * $image_url = wp_get_attachment_image_url( $imageId, 'full' );
		 */
		$attachment_srcset = wp_get_attachment_image_srcset( $imageId );
		$attachment_sizes  = wp_get_attachment_image_sizes( $imageId, 'full' );
		/**
		 * Return image with src set and sizes
		 */
		return wp_get_attachment_image(
			$imageId,
			$this->imageSize,
			false,
			array(
				'alt'     => $this->imageAltText,
				'srcset'  => $attachment_srcset,
				'sizes'   => $attachment_sizes,
				'loading' => false,
			)
		);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string {
		return view( 'components.image-component' );
	}
}
