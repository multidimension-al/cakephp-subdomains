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

namespace Multidimensional\Subdomains\Tests\TestCase\Middleware;

use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;
use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

class SubdomainMiddlewareTest extends IntegrationTestCase
{

    private $subdomainMiddleware;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        Configure::write('Multidimensional/Subdomains.Subdomains', ['admin']);
        $this->SubdomainMiddleware = new SubdomainMiddleware();
        $this->useHttpServer(true);
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        Configure::delete('Multidimensional/Subdomains.Subdomains');
        unset($this->SubdomainMiddleware);
    }

    /**
     * @return void
     */
    public function testGetSubdomains()
    {
        $subdomains = $this->SubdomainMiddleware->getSubdomains();
        $this->assertEquals($subdomains, ['admin']);
    }

    /**
     * @return void
     */
    public function testGetPrefixAndHost()
    {
        $array = $this->SubdomainMiddleware->getPrefixAndHost('admin.example.com');
        $this->assertEquals($array, ['admin', 'example.com']);
        unset($array);
        $array = $this->SubdomainMiddleware->getPrefixAndHost('subdomain.example.com');
        $this->assertEquals($array, [false, 'example.com']);
        unset($array);
        $array = $this->SubdomainMiddleware->getPrefixAndHost('example.com');
        $this->assertEquals($array, [false, 'example.com']);
    }

    /**
     * @return void
     */
    public function testInvoke()
    {
        $this->markTestIncomplete('Not implemented yet.');
        /*$this->configRequest(['uri' => ['_host' => 'admin.example.com']]);
        $request = $this->getMockBuilder('Psr\Http\Message\ServerRequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();
        $this->SubdomainMiddleware->__invoke($request, $resposne, $name);*/
    }
}
