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

namespace Multidimensional\Subdomains\Routing\Route;

use Cake\Network\Request;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

class SubdomainRoute extends Route
{

    /**
     * @param string $url
     * @param string $method
     * @return bool|array
     */
    public function parse($url, $method = '')
    {
        list($prefix) = $this->_getPrefixAndHost();

        if (!$this->_checkPrefix($prefix)) {
            return false;
        }

        return parent::parse($url, $method);
    }

    /**
     * @param array $url
     * @param array $context
     * @return bool|array
     */
    public function match(array $url, array $context = [])
    {
        if (!isset($url['prefix'])) {
            $url['prefix'] = null;
        }

        if (!$this->_checkPrefix($url['prefix'])) {
            return false;
        }

        list($prefix, $host) = $this->_getPrefixAndHost($context);

        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === 'false' ? $host : $url['prefix'] . '.' . $host;
        }

        return parent::match($url, $context);
    }

    /**
     * @param array $context
     * @return array
     */
    private function _getPrefixAndHost(array $context = [])
    {
        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::createFromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }
        $subdomainMiddleware = new SubdomainMiddleware();

        return $subdomainMiddleware->getPrefixAndHost($host);
    }

    /**
     * @param string $prefix
     * @return bool
     */
    private function _checkPrefix($prefix)
    {
        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : null;

        return $prefix === $routePrefix;
    }
}
