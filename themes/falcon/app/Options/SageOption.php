<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class SageOption extends Field {

	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Sage Option';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Sage Option | Options';

	/**
	 * The option page field group.
	 */
	public function fields(): array {
		$sageOption = Builder::make( 'sage_option' );

		$sageOption
			->addRepeater( 'items' )
				->addText( 'item' )
			->endRepeater();

		return $sageOption->build();
	}
}
