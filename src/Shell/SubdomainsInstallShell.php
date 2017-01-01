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

namespace Multidimensional\Subdomains\Shell;

use Cake\Core\Configure;
use Cake\Console\Shell;
use Cake\Console\Helper;

class SubdomainsInstallShell extends Shell {
    
	public function main() {
	
	    $this->clear();
		
		$this->_io->styles('error', ['text' => 'red']);
        $this->helper('Multidimensional/Subdomains.Header')->output();
    
        $first_run = ((Configure::check('Multidimensional/Subdomains')) ? false : true);
       
        if ((($first_run) ? (strtolower($this->in('Install Subdomains Plugin?', ['y','n'])) == 'y') : (strtolower($this->in('Update Configuration?', ['y','n'])) == 'y'))) {
			
			$this->out();
			
			$addMore = true;
			
			if ($first_run === false) {
			
          		$this->out('Current Subdomains:', 2);	
				$subdomains = Configure::consume('Multidimensional/Subdomains');
				
				if(!is_array($subdomains) && strlen($subdomains) > 0) {
					$subdomains = array($subdomains);	
				} else {
					$subdomains = array();	
				}
				
				foreach ($subdomains AS $prefix) {
					$this->out(' - ' . $prefix);	
				}
				
				if (strtolower($this->in('Add another subdomain?', ['y','n'])) == 'n') {
					$addMore = false;
				}
				
				$this->out();
				
			}
			
			if ($addMore) {
					
				do {
					
					$subdomains[] = $this->in('Subdomain:');
					$this->out();
					
					
				} while (strtolower($this->in('Add another subdomain?', ['y','n'])) == 'y');
				
			}
			
			Configure::write('Multidimensional/Subdomains', $subdomains);
			Configure::dump('subdomains', 'Multidimensional/Subdomains');
			
			$this->out('Setup Complete!');
			
		}
	
	}
	  
	  
}