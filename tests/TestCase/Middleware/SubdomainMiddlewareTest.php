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
      Configure::erase('Multidimensional/Subdomains.Subdomains');
  }
  
  public function testGetSubdomains() {
    
    
  }
  
  public function testGetPrefixAndHost() {
    
    
  }
  
  public function testInvoke() {
    
  }
  
}
