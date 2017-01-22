<?php
/**
 * CakePHP Plugin : CakePHP Subdomain Routing
 * Copyright (c) Multidimension.al (http://multidimension.al)
 * Github : https://github.com/multidimension-al/cakephp-subdomains
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     (c) Multidimension.al (http://multidimension.al)
 * @link          https://github.com/multidimension-al/cakephp-subdomains Github
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Multidimensional\Subdomains\Tests\TestCase\Routing\Route;

use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;
use Multidimensional\Subdomains\Routing\Route\SubdomainRoute;

use Cake\Routing\Router;
use Cake\Network\Request;
use Cake\Routing\Route\Route;
use Cake\TestSuite\TestCase;
use Cake\Core\Configure;

class SubdomainRouteTest extends TestCase {
    
    private $SubdomainRoute;
  
    public function setUp() {
        parent::setUp();
        Configure::write('Multidimensional/Subdomains.Subdomains', ['admin']);
        $this->SubdomainRoute = new SubdomainRoute();
    }
    
    public function tearDown() {
        unset($this->SubdomainRoute);   
    }

    /**
    * @return void
    */
    /* public function testParse() {
     *
     *   $url = ['prefix' => 'admin', 'Controller' => 'pages', 'action' => 'index'];
     *   $response = $this->SubdomainRoute->parse($url, '');
     *   //assertSame
     *   $url = ['prefix' => 'users', 'Controller' => 'pages', 'action' => 'index'];
     *   $response = $this->SubdomainRoute->parse($url, '');
     *   //assertwrong
     *
     * }
     */
    /**
    * @return void
    */
    /* public function testMatch() {
     *
     *   $url = ['prefix' => 'admin', 'Controller' => 'pages', 'action' => 'index'];
     *  $response = $this->SubdomainRoute->match($url, '');
     *   //assertSame
     *   $url = ['prefix' => 'users', 'Controller' => 'pages', 'action' => 'index'];
     *   $response = $this->SubdomainRoute->match($url, '');
     *   //assertwrong
     *
     * }
     */ 
}
