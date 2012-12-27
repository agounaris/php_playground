<?php 

class Router extends Object {
	public static $path = null;

	public static function get($route, $path) 
	{
		self::$path = $path;
		Sammy::process($route, 'GET');
	}

	public static function post($route, $path) 
	{
		self::$path = $path;
		Sammy::process($route, 'POST');
	}

	public static function put($route, $path) 
	{
		self::$path = $path;
		Sammy::process($route, 'PUT');
	}

	public static function delete($route, $path) 
	{
		self::$path = $path;
		Sammy::process($route, 'DELETE');
	}

	public static function ajax($route, $path) 
	{
		self::$path = $path;
		Sammy::process($route, 'XMLHttpRequest');
	}

	/*
	* Runs on a matching url
	*/
	public static function dispatch($format)
	{
		// define matching route
		$path = explode('#', self::$path);

		$controller = $path[0];
		$action = $path[1];

		$className = ucfirst($controller) . 'Controller';

		self::loadController('app');

		self::loadController($controller);

		if ( class_exists($className) ) {
			$tmpClass = new $className();

			// execute matching action
			if ( is_callable(array($tmpClass, $action )) ) {
				$tmpClass->$action();
			}else{
				die('The action <strong>'.$action.'</strong> could not be called from the controller <strong>'.$controller.'</strong>.');
			}

		}else{
			die('The class '.$className.' could not be found in <pre>'.APP_PATH .'Controllers/'.ucfirst($controller).'Controller.php</pre>');
		}

		// load the view file
		//self::loadView($controller, $action, $format);

		//load the layout
		$layoutPath = self::getLayout($controller, $action, $format);

		if ( !empty( $layoutPath ) ) {

			$layout = file_get_contents($layoutPath);

			$viewPath = self::viewPath($controller, $action, $format);
			if ( !empty($viewPath)) {
				$layout = str_replace('{view_content}', file_get_contents($viewPath), $layout);
			}

			$filename = BASE_PATH.'tmp/'.time().'.php';

			$file = fopen($filename, 'a');

			fwrite($file, $layout);
			fclose($file);

			self::loadLayout($filename);

			unlink($filename);
		}

	}

	public static function loadController($name)
	{
		$controllerPath = APP_PATH . 'Controllers/' . ucfirst($name) . 'Controller.php';
		
		if ( file_exists($controllerPath) ) {
			include_once $controllerPath;
		}else{
			die('The controller <strong>'.ucfirst($name).'Controller</strong> cound not be found at <pre>'.$controllerPath.'</pre>');
		}
	}

	public static function loadView($controller, $action, $format)
	{
		$viewPath = self::viewPath();
		
		if ( !empty($viewPath) ) {
			unset($controller, $action, $format);

			foreach (self::$userVars as $var => $value) {
				$$var = $value;
			}

			include_once $viewPath;
		}
	}

	public static function getLayout($controller, $action, $format)
	{
		$controllerActionPath = APP_PATH . 'Views/Layout/layout.'  . $format . '.php';

		$path = null;

		if ( file_exists($controllerActionPath) ) {
			return $controllerActionPath;
		}
	}

	public static function viewPath($controller, $action, $format)
	{
		$viewPath = APP_PATH . 'Views/' . ucfirst($controller) . '/' . $action . '.' . $format . '.php';

		$path = null;
		if ( file_exists($viewPath) ) {
			$path = $viewPath;
		}

		return $path;
	}

	public static function loadLayout($filename)
	{
		foreach (self::$userVars as $var => $value) {
			$$var = $value;
		}

		include $filename;
	}
}