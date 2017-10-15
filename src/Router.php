<?php

namespace Opportus\Router;

/**
 * The router...
 *
 * @version 0.0.1
 * @package Opportus\Router
 * @author  Clément Cazaud <opportus@gmail.com>
 */
class Router
{
	/**
	 * @var array $routes
	 */
	protected $routes = array();

	/**
	 * Registers a route.
	 *
	 * @param string $regexPath
	 * @param array  $endpoint  Respect the following structure:
	 *
	 * array(
	 *     'controller' => 'Vendor\Controller',
	 *     'action'     => 'view'
	 * )
	 */
	public function register(string $regexPath, array $endpoint)
	{
		$this->routes[$regexPath] = $endpoint;
	}

	/**
	 * Resolves the given URI's path based on the registered routes.
	 * Returns the controller, action and params.
	 *
	 * @param  string $uriPath
	 * @return array  $results
	 */
	public function resolve(string $uriPath)
	{
		$results = array();

		foreach ($this->routes as $regexPath => $endpoint) {
			if (preg_match($regexPath, $uriPath, $matches)) {
				$results['controller'] = $endpoint['controller'];
				$results['action']     = $endpoint['action'];
				$results['params']     = isset($matches[1]) ? explode('/', trim($matches[1], '/')) : array('');

				break;
			}
		}

		return $results;
	}
}

