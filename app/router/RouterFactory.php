<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
                $router[] = new Route('index.php', 'Login:login', Route::ONE_WAY);
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Login:login');
		return $router;
	}

}
