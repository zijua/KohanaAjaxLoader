<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Codebench — A dynamic content loader module.
 *
 * @package    Kohana
 * @author     Webink.it 
 * @copyright  (c) 2009 Webink.it snc
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Ajaxcontent {
	public $views = array();
	protected $config;
	public static $instance;
	protected $is_ajax = TRUE;
	protected $category = 'default';
	
	/**
	 * Ajaxcontent instance
	 * @return 
	 */
	public static function instance($category = 'default')
	{
		if ( ! isset(Ajaxcontent::$instance))
		{
			Ajaxcontent::$instance = new Ajaxcontent($category);
		}

		return Ajaxcontent::$instance;
	}
	
	/**
	 * Create an new Ajaxcontent object with the factory pattern
	 *
	 * @return  object
	 */
	public static function factory($config = array())
	{
		return new Ajaxcontent($config);
	}
	
	/**
	 * Loads configuration options.
	 *
	 * @return  void
	 */
	public function __construct($category = 'default')
	{
		// Clean up the salt pattern and split it into an array
		$this->config = Kohana::config('ajaxcontent');
		$this->is_ajax = Request::$is_ajax;
		$this->category = $category;
	}
	
	/**
	 * Render the views
	 * @param object $is_ajax [optional]
	 * @param object $category [optional]
	 * @return 
	 */
	public function views()
	{
		$views = array();
		$i = 0;
		foreach($this->config['widgets'][$this->category] as $c){
			$views[$i] = View::factory($c)->render();
			$i++;
		}
		if($this->is_ajax)
			return json_encode($views);
		else
			return $views;
	}
	
	/**
	 * Render for a single view
	 * @param object $is_ajax [optional]
	 * @param object $category [optional]
	 * @return 
	 */
	public function view($num)
	{
		if($this->is_ajax)
			return json_encode(View::factory($this->config['widgets'][$this->category][$num])->render());
		else
			return View::factory($this->config['widgets'][$this->category][$num]);
	}
	
	/**
	 * Return the number of views to load
	 * @param object $is_ajax [optional]
	 * @param object $category [optional]
	 * @return 
	 */
	public function num_of_views()
	{
		if($this->is_ajax)
			return json_encode(count($this->config['widgets'][$this->category]));
		else
			return count($this->config['widgets'][$category]);
	}
}