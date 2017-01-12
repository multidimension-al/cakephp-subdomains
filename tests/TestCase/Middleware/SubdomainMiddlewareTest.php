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
  
  public function setUp() {
      parent::setUp();
      Configure::write('Multidimensional/Subdomains.Subdomains', ['admin']);
  }
  
  public function tearDown() {
      parent::tearDown();
      Configure::delete('Multidimensional/Subdomains.Subdomains');
  }
  
  public function testGetSubdomains() {
      $subdomains = SubdomainMiddleware()->getSubdomains();
      $this->assertEquals($subdomains, ['admin']);
  }
  
  public function testGetPrefixAndHost() {
      $array = SubdomainMiddleware()->getPrefixAndHost('admin.example.com');
      $this->assertEquals($array, ['admin', 'example.com']);
      unset($array);
      $array = SubdomainMiddleware()->getPrefixAndHost('subdomain.example.com');
      $this->assertEquals($array, [false, 'example.com']);
      unset($array);
      $array = SubdomainMiddleware()->getPrefixAndHost('example.com');
      $this->assertEquals($array, [false, 'example.com']);
  }
  
  public function testInvoke() {
    
  }
  
}
