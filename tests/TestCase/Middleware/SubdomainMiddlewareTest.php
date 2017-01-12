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

namespace Multidimensional\Subdomains\Tests\TestCase\Middleware;

use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

use Cake\TestSuite\TestCase;
use Cake\Core\Configure;

class SubdomainMiddlewareTest extends TestCase {
  
  private $subdomainMiddleware;
  
  public function setUp() {
      parent::setUp();
      Configure::write('Multidimensional/Subdomains.Subdomains', ['admin']);
      $this->SubdomainMiddleware = new SubdomainMiddleware();
  }
  
  public function tearDown() {
      parent::tearDown();
      Configure::delete('Multidimensional/Subdomains.Subdomains');
      unset($this->SubdomainMiddleware);
  }
  
  public function testGetSubdomains() {
      $subdomains = $this->SubdomainMiddleware->getSubdomains();
      $this->assertEquals($subdomains, ['admin']);
  }
  
  public function testGetPrefixAndHost() {
      $array = $this->SubdomainMiddleware->getPrefixAndHost('admin.example.com');
      $this->assertEquals($array, ['admin', 'example.com']);
      unset($array);
      $array = $this->SubdomainMiddleware->getPrefixAndHost('subdomain.example.com');
      $this->assertEquals($array, [false, 'example.com']);
      unset($array);
      $array = $this->SubdomainMiddleware->getPrefixAndHost('example.com');
      $this->assertEquals($array, [false, 'example.com']);
  }
  
  public function testInvoke() {
      $this->configRequest(['uri' => ['_host' => 'admin.example.com']]);
      $request = $this->getMockBuilder('Psr\Http\Message\ServerRequestInterface')->getMock();
      $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();
      //$this->SubdomainMiddleware->__invoke($request, $resposne, $name);
  }
  
}
