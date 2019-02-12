<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
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
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
     /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    //$routes->connect('/notes', ['controller' => 'Pages', 'action' => 'notes']);

    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/respofinance/*', ['controller' => 'Respofinance', 'action' => 'display']);
     $routes->scope('/Etudiants',function($routes){
        $routes->connect('/indexCertificats',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
        $routes->connect('/index-certificats',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
        $routes->connect('/entreprise',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
    });

    $routes->scope('/etudiants',function($routes){
        $routes->connect('/indexCertificats',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
        $routes->connect('/index-certificats',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
        $routes->connect('/entreprise',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
    });
    $routes->scope('/respostages',function($routes){
        $routes->connect('/index-certificats', ['controller' => 'respostages', 'action' => 'searchCertificats', '_method'=>'POST']);
        $routes->connect('/', ['controller' => 'respostages', 'action' => 'index']);
    });
    $routes->scope('/resposcolarites',function($routes){

        $routes->connect('/index-certificats',['controller' => 'Resposcolarites','action' => 'searchCertificats', '_method' => 'POST']);
        $routes->connect('/indexCertificats',['controller' => 'Resposcolarites','action' => 'searchCertificats', '_method' => 'POST']);
    });

    $routes->scope('/notes',function($routes){
        $routes->connect('/',['controller' => 'Pages','action' => 'notes']);
        $routes->connect('/index-certificats',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
        $routes->connect('/entreprise',['controller' => 'Etudiants','action' => 'postCertificats', '_method' => 'POST']);
    });
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

Router::scope('/Ensaksite/respostocks/', function (\Cake\Routing\RouteBuilder $routes) {
    $routes->addExtensions(['pdf']);
    // ...
});


Router::scope('/resposcolarites', function($routes) {
    $routes->connect(
        '/liste-classes',
        ['controller' => 'Resposcolarites', 'action' => 'show_classes', '_method' => 'GET']
    );
    $routes->connect(
        '/liste-pv-notes',
        ['controller' => 'Resposcolarites', 'action' => 'showPvNote', '_method' => 'GET']
    );
    /*$routes->connect(
        '/ajouter-codes',
        ['controller' => 'Resposcolarites', 'action' => 'addKey', '_method' => 'GET']
    );*/
});


Router::connect('/profvacataires/liste-classes', ['controller' => 'Profvacataires', 'action' => 'showClass']);
Router::connect('/profvacataires/liste-modules', ['controller' => 'Profvacataires', 'action' => 'showModel']);
Router::connect('/profvacataires/liste-elements', ['controller' => 'Profvacataires', 'action' => 'showElement']);
Router::connect('/profvacataires/liste-etudiants', ['controller' => 'Profvacataires', 'action' => 'showStudents']);
Router::connect('/profvacataires/verifier-code', ['controller' => 'Profvacataires', 'action' => 'checkKey']);
Router::scope('/profvacataires', function($routes) {
    // This route only matches on POST requests.
    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profvacataires', 'action' => 'addNote', '_method' => 'POST']
    );

    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profvacataires', 'action' => 'addDemandeKey', '_method' => 'POST']
    );

    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profvacataires', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/liste-etudiants',
        ['controller' => 'Profvacataires', 'action' => 'showStudentDetail', '_method' => 'GET']
    );
});

Router::connect('/profpermanents/liste-classes', ['controller' => 'Profpermanents', 'action' => 'showClass']);
Router::scope('/profpermanents', function($routes) {
    // POST
    $routes->connect(
        '/liste-etudiants',
        ['controller' => 'Profpermanents', 'action' => 'showStudents', '_method' => 'POST']
    );

    $routes->connect(
        '/verifier-code',
        ['controller' => 'Profpermanents', 'action' => 'checkKey', '_method' => 'POST']
    );

    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profpermanents', 'action' => 'addNote', '_method' => 'POST']
    );

    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profpermanents', 'action' => 'addDemandeKey', '_method' => 'POST']
    );

    $routes->connect(
        '/liste-modules',
        ['controller' => 'Profpermanents', 'action' => 'showElement', '_method' => 'POST']
    );

    $routes->connect(
        '/liste-elements',
        ['controller' => 'Profpermanents', 'action' => 'showModel', '_method' => 'POST']
    );

    // GET
    $routes->connect(
        '/showElement',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/showStudents',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/liste-etudiants',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/verifier-code',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/ajouter-notes',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/liste-modules',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/liste-elements',
        ['controller' => 'Profpermanents', 'action' => 'showClass', '_method' => 'GET']
    );

    $routes->connect(
        '/liste-etudiants-detail',
        ['controller' => 'Profpermanents', 'action' => 'showStudentDetail', '_method' => 'GET']
    );
});