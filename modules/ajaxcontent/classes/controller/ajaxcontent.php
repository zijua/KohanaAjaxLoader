<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Codebench — A dynamic content loader module.
 *
 * @package    Kohana
 * @author     Webink.it 
 * @copyright  (c) 2009 Webink.it snc
 * @license    http://kohanaphp.com/license.html
 */
class Controller_Ajaxcontent extends Controller {
	
	public function before(){
		if(!Request::$is_ajax)
			return;
	}
	
	public function action_views($category = 'default'){
			$ajcont = Ajaxcontent::instance($category);
			$this->request->response = $ajcont->views();
	}
	
	public function action_view($num, $category = 'default'){
			$ajcont = Ajaxcontent::instance($category);
			$this->request->response = $ajcont->view($num);
	}
	
	public function action_num_of_views($category = 'default'){
			$ajcont = Ajaxcontent::instance($category);
			$this->request->response = $ajcont->num_of_views(Request::$is_ajax, $category);
	}
}
