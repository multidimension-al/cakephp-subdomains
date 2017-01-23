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

namespace Multidimensional\Subdomains\View\Helper;

use Cake\View\Helper\HtmlHelper;

class SubdomainHtmlHelper extends HtmlHelper
{

    public function link($title, $url = null, array $options = [])
    {
        if (isset($url['prefix']) && $url['prefix'] === false) {
            $url['prefix'] = "false";
        }
        if (is_array($title) && isset($title['prefix']) && $title['prefix'] === false) {
            $title['prefix'] = "false";
        }
        
        return parent::link($title, $url, $options);
    }

}