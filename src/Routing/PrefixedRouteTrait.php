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
 
namespace Multidimensional\Subdomains\Routing;

use Cake\Network\Request; 
use Cake\Routing\Router;
use Cake\Core\Configure;

trait PrefixedRouteTrait
{
    private $prefixes = [];
	
	//Add prefixes from Config

    private function getPrefixAndHost(array $context = []) {
        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::createFromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }
        $parts = explode('.', $host, 2);
        if (in_array($parts[0], $this->prefixes)) {
            return $parts;
        } else {
            return [false, $host];
        }
    }

    private function checkPrefix($prefix) {
        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : false;
        return $prefix === $routePrefix;
    }

    public function parse($url) {
        list($prefix) = $this->getPrefixAndHost();
        if (!$this->checkPrefix($prefix)) {
            return false;
        }
        return parent::parse($url);
    }

    public function match(array $url, array $context = []) {
        if (!isset($url['prefix'])) {
            $url['prefix'] = false;
        }
        if (!$this->checkPrefix($url['prefix'])) {
            return false;
        }
        list($prefix, $host) = $this->getPrefixAndHost($context);
        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === false ? $host : $url['prefix'] . '.' . $host;
        }
        return parent::match($url, $context);
    }
}