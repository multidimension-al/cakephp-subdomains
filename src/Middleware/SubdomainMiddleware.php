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

namespace Multidimensional\Subdomains\Middleware;

use Cake\Core\Configure;

class SubdomainMiddleware {
		
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Message\ResponseInterface $response The response.
     * @param callable $next The next middleware to call.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function __invoke($request, $response, $next) {
		
        $subdomains = $this->_getSubdomains();
		
        $uri = $request->getUri();
        $host = $uri->getHost();
		
        if (preg_match('/(.*?)\.([^\/]*\..{2,5})/i', $host, $parts)) {
			
            if (in_array($parts[1], $subdomains)) {
			
                $params = (array) $request->getAttribute('params', []);
				
                if (empty($params['prefix'])) {
                    $params['prefix'] = $parts[1];			
                }
				
                $request = $request->withAttribute('params', $params);
			
            }
		
        }
		
        return $next($request, $response);
		
    }	
	
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
	
}