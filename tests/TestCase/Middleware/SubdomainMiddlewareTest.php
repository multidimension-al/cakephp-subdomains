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
	private $defaultSubdomains;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        Configure::write('Multidimensional/Subdomains.Subdomains', ['admin']);
        $this->subdomainMiddleware = new SubdomainMiddleware();
		$this->defaultSubdomains = $this->subdomainMiddleware->defaultSubdomains;
        $this->useHttpServer(true);
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        Configure::delete('Multidimensional/Subdomains.Subdomains');
        unset($this->subdomainMiddleware);
		unset($this->defaultSubdomains);
    }

    /**
     * @return void
     */
    public function testGetSubdomains()
    {
        $subdomains = $this->subdomainMiddleware->getSubdomains();
        $this->assertEquals($subdomains, array_merge($this->defaultSubdomains, ['admin']));
    }

    /**
     * @return void
     */
    public function testGetPrefixAndHost()
    {
        $array = $this->subdomainMiddleware->getPrefixAndHost('admin.example.com');
        $this->assertEquals($array, ['admin', 'example.com']);
        $array = $this->subdomainMiddleware->getPrefixAndHost('subdomain.example.com');
        $this->assertEquals($array, [false, 'example.com']);
        $array = $this->subdomainMiddleware->getPrefixAndHost('example.com');
        $this->assertEquals($array, [false, 'example.com']);
		$array = $this->subdomainMiddleware->getPrefixAndHost('www.example.com');
        $this->assertEquals($array, ['www', 'example.com']);
        $array = $this->subdomainMiddleware->getPrefixAndHost('false.example.com');
        $this->assertEquals($array, ['false', 'example.com']);
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
        $this->subdomainMiddleware->__invoke($request, $resposne, $name);*/
    }
}
