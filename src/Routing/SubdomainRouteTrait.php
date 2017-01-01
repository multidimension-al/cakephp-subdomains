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

trait SubdomainRouteTrait {

    private function _getSubdomains() {

        $validConfiguration = Configure::check('Multidimensional/Subdomains.subdomains');

        if (!$validConfiguration) {
            return [];
        }

        $subdomains = Configure::read('Multidimensional/Subdomains.subdomains');

        if (!is_array($subdomains) || count($subdomains) == 0) {
            return [];
        }

        return $subdomains;

    }

    private function _getPrefixAndHost(array $context = []) {
        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::createFromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }
        $parts = explode('.', $host, 2);
        if (in_array($parts[0], $this->_getSubdomains())) {
            return $parts;
        } else {
            return [false, $host];
        }
    }

    private function _checkPrefix($prefix) {
        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : false;
        return $prefix === $routePrefix;
    }

    public function parse($url, $method = '') {
        list($prefix) = $this->_getPrefixAndHost();
        if (!$this->_checkPrefix($prefix)) {
            return false;
        }
        return parent::parse($url, $method);
    }

    public function match(array $url, array $context = []) {
        if (!isset($url['prefix'])) {
            $url['prefix'] = false;
        }
        if (!$this->_checkPrefix($url['prefix'])) {
            return false;
        }
        list($prefix, $host) = $this->_getPrefixAndHost($context);
        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === false ? $host : $url['prefix'] . '.' . $host;
        }
        return parent::match($url, $context);
    }
}
