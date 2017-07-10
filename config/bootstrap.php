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

namespace Multidimensional\Subdomains\Config;

use Cake\Core\Configure;
use Cake\Event\EventManager;
use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

/*
 *
 *  DO NOT EDIT THIS CONFIGURATION! YOUR CHANGES WON'T SAVE THROUGH
 *  UPDATES! ONLY EDIT THE CONFIG/SUBDOMAINS.PHP FILE IN THE MAIN CONFIG
 *
 */

$subdomainConfig = ['Subdomains' => null];

if (file_exists(CONFIG . 'subdomains.php')) {
    Configure::load('subdomains');
} else {
    Configure::write('Multidimensional/Subdomains', $subdomainConfig);
}

/*
 *  Middleware
 */

EventManager::instance()->on(
    'Server.buildMiddleware',
    function ($event, $middleware) {
        $middleware->add(new SubdomainMiddleware());
    }
);
