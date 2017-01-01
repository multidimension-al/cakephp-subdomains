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
	
		$subdomains = array();	
	
	    $this->clear();
		
		$this->_io->styles('error', ['text' => 'red']);
        $this->helper('Multidimensional/Subdomains.Header')->output();
    
        $first_run = Configure::check('Multidimensional/Subdomains.subdomains') ? false : true;
		
		if ($first_run == false) {
			
			$subdomains = Configure::consume('Multidimensional/Subdomains.subdomains');
			
			if (count($subdomains) == 0) {
				$first_run = true;
			}
			
		}
	   
        if ((($first_run) ? (strtolower($this->in('Install Subdomains Plugin?', ['y','n'])) == 'y') : (strtolower($this->in('Update Configuration?', ['y','n'])) == 'y'))) {
			
			do {
				
				$this->out();
				
				$addMore = true;
				
				if ($first_run === false && count($subdomains) > 0) {
				
					$this->out('Current Subdomains:', 2);	
								
					foreach ($subdomains AS $prefix) {
						$this->out(' - ' . $prefix);	
					}
					
					$this->out();
					
					if (strtolower($this->in('Add Another Subdomain?', ['y','n'])) == 'n') {
						$addMore = false;
					}
									
				}
				
				if ($addMore) {
						
					if (count($subdomains) == 0) {
						$this->out('Add Your First Subdomain.');
					}
						
					do {
						
						$valid = true;
						$this->out();
						$subdomain = $this->in('Subdomain:');
						if (preg_match('/^[A-Za-z0-9]{1}(?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9]{1})?$/', $subdomain, $matches)) {
							$subdomains[] = $subdomain;
							$valid = true;
							$this->out();
						}else{
							$valid = false;
							$this->out();
							$this->_io->out('<error>Invalid Subdomain.</error>');
						}
						
					} while (!$valid || strtolower($this->in('Add Another Subdomain?', ['y','n'])) == 'y');
					
				}
				
				$subdomains = array_values(array_unique($subdomains));
				
				$subdomains = $this->_modifyArray($subdomains);
				
				$this->out();
				$this->out('Current Subdomains:', 2);
				
				if (count($subdomains) > 0) {
					foreach ($subdomains AS $key => $value) {
						$this->out(' ' . ($key) . '. ' . $value);	
					}				
				}
				
				$this->out();
							
				while (count($subdomains) > 0 && strtolower($this->in('Delete a Subdomain?', ['y','n'])) == 'y') {
					
					$this->out();
					$deleteKey = (int) $this->in('Enter Number to Delete:', array_keys($subdomains));
					
					if (isset($subdomains[$deleteKey])) {
						$this->out();
						$this->out('Deleted: ' .  $subdomains[$deleteKey], 2);
						unset($subdomains[$deleteKey]);	
					}
					
				}
				
				Configure::write('Multidimensional/Subdomains.subdomains', array_values($subdomains));
				Configure::dump('subdomains', 'default', ['Multidimensional/Subdomains']);
				
				if (count($subdomains) == 0) {
					$this->out();
					$this->_io->out('<error>No Subdomains Configured.</error>', 2);					
				}
				
			} while (count($subdomains) == 0 && strtolower($this->in('Start Over?', ['y','n'])) == 'y');
			
			$this->out();
			if(count($subdomains) > 0) {
				$this->out('Configuration Saved!', 2);
			} else {
				$this->_io->out('<error>Plugin Not Currently Active.</error>', 2);	
			}
		}
	
	}
	
	private function _modifyArray(array $array) {

		return array_combine(range(1, count($array)), array_values($array));;	
		
	}
	  
	  
}