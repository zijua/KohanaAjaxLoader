<?php defined('SYSPATH') or die('No direct script access.');

Route::set('ajaxcontent/view', '<controller>(/<action>(/<num>(/<category>)))', array('num' => '[0-9]+', 'category' => '[a-zA-Z0-9_]+'))
	->defaults(array(
		'controller' => 'ajaxcontent',
		'action'     => 'view',
		'num'      => 0,
		'category'      => 'default',
	));