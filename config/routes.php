<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Users', 'action' => 'login']);
	    $builder->connect('/salir', ['controller' => 'Users', 'action' => 'logout']);
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');
        $builder->connect('/manual/*', 'Pages::manual');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */

	$routes->prefix('dienst', function (RouteBuilder $routes) {

		$routes->scope('/', function (RouteBuilder $builder) {
			$builder->connect('/manual/*',  ['controller' =>'Pages', 'action' => 'manual', 'prefix' => null]);
			$builder->connect('/', ['controller' => 'Candidates', 'action' => 'index']);
			$builder->connect('/aspirantes', ['controller' => 'Candidates', 'action' => 'index']);
			$builder->connect('/aspirantes/editar/{id}', ['controller' => 'Candidates', 'action' => 'edit'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);;
			$builder->connect('/aspirantes/agregar', ['controller' => 'Candidates', 'action' => 'add']);
			$builder->connect('/aspirantes/importar', ['controller' => 'Candidates', 'action' => 'importar']);

			$builder->connect('/preocupacionales/asignarTurno/{id}', ['controller' => 'Preoccupationals', 'action' => 'assignDate'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);
			$builder->connect('/preocupacionales/asignarTurno/{id}/{forzar}', ['controller' => 'Preoccupationals', 'action' => 'assignDate'])
				->setPass(['id', 'forzar'])
				->setPatterns([
					'id' => '[0-9]+',
			]);

			$builder->connect('/preocupacionales/modificarTurno/{id}', ['controller' => 'Preoccupationals', 'action' => 'modifyDate'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);


			$builder->connect('/preocupacionales/ver/{id}', ['controller' => 'Candidates', 'action' => 'View'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);
			$builder->connect('/preocupacionales/borrar/{id}', ['controller' => 'Candidates', 'action' => 'Delete'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);
			$builder->connect('/preocupacionales/asignarTurnoMasivo', ['controller' => 'Preoccupationals', 'action' => 'assignDateMassive']);
			$builder->connect('/preocupacionales/sin-revisar', ['controller' => 'Candidates', 'action' => 'toCheck']);

			$builder->fallbacks();
		});

		$routes->fallbacks(DashedRoute::class);
	});

	$routes->prefix('Admin', function (RouteBuilder $routes) {

		$routes->scope('/', function (RouteBuilder $builder) {
			$builder->connect('/manual/*',  ['controller' =>'Pages', 'action' => 'manual', 'prefix' => null]);
			$builder->connect('/', ['controller' => 'users', 'action' => 'index']);
			$builder->connect('/usuarios', ['controller' => 'users', 'action' => 'index']);
			$builder->connect('/usuarios/agregar', ['controller' => 'users', 'action' => 'add']);

			$builder->fallbacks();
		});

		$routes->fallbacks(DashedRoute::class);
	});

	$routes->prefix('centroMedico', function (RouteBuilder $routes) {

		$routes->scope('/', function (RouteBuilder $builder) {
			$builder->connect('/manual/*',  ['controller' =>'Pages', 'action' => 'manual', 'prefix' => null]);
			$builder->connect('/', ['controller' => 'Candidates', 'action' => 'index']);
			$builder->connect('/preocupacionales/sin-finalizar', ['controller' => 'Candidates', 'action' => 'waitingDocumentation']);
			$builder->connect('/preocupacionales/presente/{id}', ['controller' => 'Preoccupationals', 'action' => 'edit'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);

			$builder->connect('/preocupacionales/ver/{id}', ['controller' => 'Preoccupationals', 'action' => 'view'])
				->setPass(['id'])
				->setPatterns([
					'id' => '[0-9]+',
				]);
			$builder->fallbacks();
		});

		$routes->fallbacks(DashedRoute::class);
	});

	$routes->scope('/api', function (RouteBuilder $builder) {
		$builder->setExtensions(['json', 'xml']);
		$builder->connect('/login', ['controller' => 'Preoccupationals', 'action' => 'login', '_ext' => 'json']);
		$builder->connect('/preocupacionales', ['controller' => 'Preoccupationals', 'action' => 'index', '_ext' => 'json']);
		$builder->fallbacks();
	});



};


