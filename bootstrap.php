<?php

/* My bootstrap/router */

/**
* Get an array of key value pairs. As of now,
* the only thing needed is 'action' => 'show', 'controller' => 'FireEngineController'
* controller should be the classname.
* URLs look like this http://www.server.url/controller/[action/[id]] for example:
* http://localhost/money/new
* http://localhost/user/edit/12 - in this case, I leave it up to you to create a 
* UserController with an EditAction which then uses Doctrine to get the User with an id of 12
* This relies on .htaccess to pull apart the url and build the 
* request to index.php?controller=<controller>&action=<action>&id=<id>
* All completely customizable to your needs - this is a simple foundation framework
* @author Adam R. Medeiros
*/
function getActionController($params)
{
	$ret = array('action' => 'indexAction', 'controller' => 'IndexController');
	
	$arr = array($params['action'], $params['controller']);
	
	if (!$params || !$params['action'] || !$params['controller']) return $ret;
	
	return array(
			'action' => strtolower($params['action']) . 'Action', 
			'controller' => ucfirst($params['controller']) . 'Controller'
	);
}

/**
 * Auto loader.
 */
function __autoload($className)
{
	$classPaths = array(
		'lib/',
		'app/controllers/',
		'app/models/',
		'app/models/generated/'
	);
	
	$className .= '.php';
	$rootPath = dirname(__FILE__);
	
	// Identify if this is just a Doctrine class.
	// If so, limit the loop to just the path that
	// holds the doctrine stuff and require that
	// class if it exists.
	if (preg_match('/Doctrine/', $className))
	{
		$classPaths = array('lib/vendor/doctrine/lib/');
		$className = str_replace('_', '/', $className);
	}
	
	foreach($classPaths as $path) 
	{
		$absPath = $rootPath . '/' . $path;
		if (file_exists($absPath . $className))
		{
			require_once($absPath . $className);
			return true;
		}
		
		// Hey - check to see if they have entered a bogus controller name
		else if ($path=='app/controllers/' && preg_match("/Controller/", $className)) 
		{
			header('location: /error/notfound');
			exit;
		}
		
	}
	
}


// Get our config
$iniPath = dirname(__FILE__) . '/config/config.ini';
$conf = parse_ini_file($iniPath,true);


// get the action/controller array based upon the request
$actionController = getActionController($_GET);

// Init the Mvc and get it ready to run - args are action, controller, request params
// One would really want to keep the post and get separated and together in a production app - which
// is easy to do.  For the sake of time, I merged them and don't have them separate.
$mvc = new Mvc($actionController['controller'], $actionController['action'], array_merge($_GET,$_POST));

// Init Doctrine
// Using Doctrine for my ORM.  I have built my own ORM's in the past, but having the flexibility to use
// almost any database is good.  Doctrine has a lot of features too - makes sense to use something like
// it.
$manager = Doctrine_Manager::getInstance();

// Create our connection - Doctrine doesn't actually connect unless it's needed - saving some resources.
$dbConf = $conf['DB'];
$dsn = $dbConf['dsn'];
$user = $dbConf['username'];
$password = $dbConf['password'];

$dbh = new PDO($dsn, $user, $password);
$conn = Doctrine_Manager::connection($dbh, 'doctrine');
$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

// Load our Doctrine generated models
Doctrine_Core::loadModels(dirname(__FILE__) . '/app/models');


