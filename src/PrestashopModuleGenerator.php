<?php
/**
* PrestashopModuleGenerator 
*
* To create Prestashop Module files skeleton 
* 
* @author sebastienmonterisi@yahoo.fr
**/

use Symfony\Component\Yaml\Parser;

class PrestashopModuleGenerator
{
	//protected $template;
	
	/*
	* @var Twig_Environement Twig environement instance
	*/
	private $twig;

	/**
	* @var $configFile string Path to yaml config file
	**/
	protected static $configFile = '/../config/PrestashopModuleGeneratorConfig.yml';

	/**
	* @var $hooks array Prestashop hooks [ ([name],[title],[description]), () ...]
	**/
	protected static $hooks = array();

	/**
	* @var $config array PrestashopModuleGenerator configurations datas (hooks, tabs)
	**/
	protected static $config = array();

	/**
	* @var $tabs array Prestashop admin tabs [ [id],... ]
	**/
	protected static $tabs = array();

	public function __construct($app)
	{
		$filter = new Twig_SimpleFilter('ucfirst', 'ucfirst');
		$this->twig = $app['twig'];
		$this->twig->addFilter($filter);
	}

	/**
	*
	* @return mixed bool|string False if failled, url to generated file if success
	*/
	public function generate($data)
	{
		// $this->twig->loadTemplate('module.php.twig');
		// $output = $this->twig->render('module.php.twig', $data);
		return $this->twig->render('module.php.twig', $data);
	}

	/**
	* Prestashop Hooks
	*
	* @return Array Prestashop hooks [ ([name],[title],[description]), () ...]
	*/
	public static function getHooks()
	{
	 	if(empty(self::$hooks))
	 	{
	 		$cfg = self::getConfig();
	 		self::$hooks = $cfg['hooks'];
	 	}
	 	return self::$hooks;
	}

	/**
	* Prestashop Hooks
	*
	* @return Array Prestashop hooks [ ([name],[title],[description]), () ...]
	*/
	public static function getTabs()
	{
	 	if(empty(self::$tabs))
	 	{
	 		$cfg = self::getConfig();
	 		self::$tabs = $cfg['tabs'];
	 	}
	 	return self::$tabs;
	}

	protected static function getConfig()
	{
		if(empty(self::$config))
		{
			self::$config = (new Parser())->parse(file_get_contents(__DIR__.self::$configFile));
		}
		return self::$config;
	}
}
