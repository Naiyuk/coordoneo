<?php

declare(strict_types=1);

/**
 * Router class
 */

namespace Framework\Routing;

use Framework\{
	Routing\Route,
	Exception\NotFoundHttpException
};

/**
 * Router
 */
class Router
{
	/**
	 * 
	 * @var array
	 * @access private
	 */
	private $routes = [];
	
	/**
	 * Add Route
	 * @access public
	 * @param Route $route
     * 
	 * @return void
	 */
	public function addRoute(Route $route): void
	{
		if (!in_array($route, $this->routes)) {

			$this->routes[] = $route;
		}
	}
	
	/**
	 * Get Route match with url
	 * @access public
	 * @param string $url
     * 
	 * @return Route
	 */
	public function getRoute($url): ?Route
	{
		foreach ($this->routes as $route) {

			// If url match with Route url
			if (($varsValues = $route->match($url)) !== false) {

				// If route has vars, example : id
				if ($route->hasVars()) {

					// Get vars names
					$varsNames = $route->getVarsNames();
					$listVars = [];

					foreach ($varsValues as $key => $match) {

						// 0 contains complete url
						if ($key !== 0) {

							// Set array with names/values of vars
							$listVars[$varsNames[$key - 1]] = $match;
						}
					}
					
					$route->setVars($listVars);
				}
	
				return $route;
			}
		}
	
		throw new NotFoundHttpException('Page non trouvée');
        
	}

    /**
     * Get url by route name
     * @access public
     * @param string $routeName
     * @param array $param
     * 
     * @return string
     */
	public function getUrlByRouteName($routeName, array $param = []): string
	{
		foreach ($this->routes as $route) {

			if ($route->getName() == $routeName) {

				if ($route->hasVars()) {
					$keysValues = array_keys($param);

					foreach($keysValues as $key => $value) {
						$keysValues[$key] = '/(' . $value . ')/';
					}

					$url = preg_replace($keysValues, $param, $route->getMask());

					return $url;
				}

				return $route->getUrl();
			}
		}
	}

	/**
	 * Load routes
	 * @access public
     * 
	 * @return void
	 */
	public function loadRoutes(): void
	{
		$xml = new \DOMDocument();
		$xml->load(__DIR__.'/../../app/config/routes.xml');
	
		$xmlRoutes = $xml->getElementsByTagName('route');
			
		foreach ($xmlRoutes as $xmlRoute) {

			$varsNames = [];
			
			// If route has vars, example : id
			if ($xmlRoute->hasAttribute('vars')) {

				// Get vars names in array
				$varsNames = explode(',', $xmlRoute->getAttribute('vars'));
            }
            
            $route = new Route();

            $route->setUrl($xmlRoute->getAttribute('url'));
            $route->setController($xmlRoute->getAttribute('controller'));
            $route->setAction($xmlRoute->getAttribute('action'));
            $route->setName($xmlRoute->getAttribute('name'));

            if ($xmlRoute->hasAttribute('mask')) {
                $route->setMask($xmlRoute->getAttribute('mask'));
            }

            $route->setVarsNames($varsNames);
			
			// Add route in routes array of Router
			$this->addRoute($route);
		}
    }
}