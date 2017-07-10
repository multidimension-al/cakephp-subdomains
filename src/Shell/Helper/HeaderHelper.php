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

namespace Multidimensional\Subdomains\Shell\Helper;

use Cake\Console\Helper;

class HeaderHelper extends Helper
{

    /**
     * @param null $args
     * @return void
     */
    public function output($args = null)
    {
        $this->_io->out("\n\n");
        $this->_io->styles('header', ['text' => 'green']);

        $this->_io->out('<header>   ______  _____  ___  ____  __  ______   _____  ______</header>');
        $this->_io->out('<header>  / __/ / / / _ )/ _ \/ __ \/  |/  / _ | /  _/ |/ / __/</header>');
        $this->_io->out('<header> _\ \/ /_/ / _  / // / /_/ / /|_/ / __ |_/ //    /\ \  </header>');
        $this->_io->out('<header>/___/\____/____/____/\____/_/  /_/_/ |_/___/_/|_/___/  </header>');
        $this->_io->out("\n");
        $this->_io->out('<header>              CakePHP : Subdomains Router              </header>');
        $this->_io->out('<header>              by https://multidimension.al             </header>');
        $this->_io->out("\n\n");
    }
}
