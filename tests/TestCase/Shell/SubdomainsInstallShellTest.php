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
 * @copyright (c) Multidimension.al (http://multidimension.al)
 * @link      https://github.com/multidimension-al/cakephp-subdomains Github
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Multidimensional\Subdomains\Tests\TestCase\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Multidimensional\Subdomains\Shell\SubdomainsInstallShell;

class SubdomainsInstallShellTest extends TestCase
{

    private $subdomains;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->subdomains = new SubdomainsInstallShell();
    }

    /**
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
