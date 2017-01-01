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

namespace Multidimensional\Subdomains\Shell\Helper;

use Cake\Console\Helper;

class HeaderHelper extends Helper {
    public function output ($args = null) {
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
