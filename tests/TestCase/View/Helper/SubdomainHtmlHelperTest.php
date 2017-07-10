<?php
/**
 *      __  ___      ____  _     ___                           _                    __
 *     /  |/  /_  __/ / /_(_)___/ (_)___ ___  ___  ____  _____(_)___  ____   ____ _/ /
 *    / /|_/ / / / / / __/ / __  / / __ `__ \/ _ \/ __ \/ ___/ / __ \/ __ \ / __ `/ /
 *   / /  / / /_/ / / /_/ / /_/ / / / / / / /  __/ / / (__  ) / /_/ / / / // /_/ / /
 *  /_/  /_/\__,_/_/\__/_/\__,_/_/_/ /_/ /_/\___/_/ /_/____/_/\____/_/ /_(_)__,_/_/
 *
 * CakePHP Plugin : CakePHP Subdomain Routing
 * Copyright (c) Multidimension.al (http://multidimension.al)
 * Github : https://github.com/multidimension-al/cakephp-subdomains
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright  Copyright © 2016-2017 Multidimension.al (http://multidimension.al)
 * @link       https://github.com/multidimension-al/cakephp-subdomains Github
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Multidimensional\Subdomains\Tests\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Multidimensional\Subdomains\View\Helper\SubdomainHtmlHelper;

class SubdomainHtmlHelperTest extends TestCase
{

    public $helper = null;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->helper = new SubdomainHtmlHelper($view);
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->View);
        unset($this->helper);
    }

    /**
     * @return void
     */
    public function testLink()
    {
        /*Router::connect('/:controller/:action/*');

        $result = $this->helper->link('/home');
        $expected = ['a' => ['href' => '/home'], 'preg:/\/home/', '/a'];
        $this->assertHtml($expected, $result);

        $result = $this->helper->link('http://www.example.org?param1=value1&param2=value2');
        $expected = ['a' => ['href' => 'http://www.example.org?param1=value1&amp;param2=value2'], 'http://www.example.org?param1=value1&amp;param2=value2', '/a'];
        $this->assertHtml($expected, $result);

        $result = $this->helper->link('Google.com', 'http://www.google.com');
        $expected = ['a' => ['href' => 'http://www.google.com'], 'Google.com', '/a'];
        $this->assertHtml($expected, $result);

        $result = $this->helper->link('http://admin.example.com');
        $expected = ['a' => ['href' => 'http://admin.example.com'], 'http://admin.example.com', '/a'];
        $this->assertHtml($expected, $result);

        Router::scope('/', ['prefix' => 'admin'],
            function ($routes) {
                $routes->fallbacks();
            }
        );

        $result = $this->helper->link('Admin Panel', ['prefix' => 'admin', 'controller' => 'test', 'action' => 'index']);
        $expected = ['a' => ['href' => 'http://admin.example.com'], 'http://admin.example.com', '/a'];*/

        $this->markTestIncomplete('Not implemented yet.');
    }
}
