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

namespace Multidimensional\Subdomains\Tests\TestCase\Shell;

use Multidimensional\Subdomains\Shell\SubdomainsInstallShell;
use Multidimensional\Subdomains\Test\Shell\SubdomainsInstallShell;

use Cake\Core\Configure;
use Cake\Console\Shell;

use Cake\TestSuite\TestCase;

class SubdomainsInstallShellTest extends TestCase {
  
    private $subdomains;
    
    public function setUp() {
        parent::setUp();
        
        $this->subdomains = new SubdomainsInstallShell();
        
    }
  
    public function testModifyArray() {
   
    }
    
    public function testValidateSubdomain() {
        
    }
    
    public function testCountSubdomains() {
        
        $rand = rand(3,9);
        $array = range(1, $rand);
        $count = $this->subdomains->invokeMethod($this->subdomains, '_countSubdomains', [$array]);
        $this->assertEquals($count, $rand);
      
    }
  
}
