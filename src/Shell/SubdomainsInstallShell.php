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

class SubdomainsInstallShell extends Shell {
    
    public function main () {
    
        $subdomains = array();    
    
        $this->clear();
        
        $this->helper('Multidimensional/Subdomains.Header')->output();
    
        $first_run = Configure::check('Multidimensional/Subdomains.subdomains') ? false : true;
        
        if ($first_run === false) {
            
            $subdomains = Configure::consume('Multidimensional/Subdomains.subdomains');
            
            if (count($subdomains) == 0) {
                $first_run = true;
            }
            
        }
       
        if ((($first_run) ? (strtolower($this->in('Install Subdomains Plugin?', ['y', 'n'])) == 'y') : (strtolower($this->in('Update Configuration?', ['y', 'n'])) == 'y'))) {
            
            do {
                
                $addMore = true;
                
                if ($first_run === false && $this->_countSubdomains($subdomains)) {
                
                    $subdomains = array_values(array_unique($subdomains));
                    
                    $subdomains = $this->_modifyArray($subdomains);
                    
                    $this->_currentSubdomains($subdomains);
                    
                    $addMore = $this->_askAddSubdomain();
                                    
                }
                
                if ($addMore) {
                        
                    if (!$this->_countSubdomains($subdomains)) {
                        $this->out();
                        $this->out('Add Your First Subdomain.');
                    }
                        
                    do {
                        
                        $this->out();
                        
                        $subdomain = $this->in('Subdomain:');
                        $valid = $this->_validateSubdomain($subdomain);

                        $this->out();
                        
                        if ($valid) {
                            $subdomains[] = $subdomain;
                        } else {
                            $this->err('Invalid Subdomain.');
                        }
                        
                    } while (!$valid || $this->_askAddSubdomain());
                    
                }
                
                $subdomains = array_values(array_unique($subdomains));
                
                $subdomains = $this->_modifyArray($subdomains);
                
                $this->_currentSubdomains($subdomains);
                            
                while ($this->_countSubdomains($subdomains) && $this->_askDeleteSubdomain()) {
                    
                    $this->out();
                    $deleteKey = (int) $this->in('Enter Number to Delete:', array_keys($subdomains));
                    
                    $this->_deleteSubdomain($subdomains, $deleteKey);
                    
                }
                
                Configure::write('Multidimensional/Subdomains.subdomains', array_values($subdomains));
                Configure::dump('subdomains', 'default', ['Multidimensional/Subdomains']);
                
                if (!$this->_countSubdomains($subdomains)) {
                    $this->out();
                    $this->err('No Subdomains Configured.', 2);                    
                }
                
            } while (count($subdomains) == 0 && $this->_askStartOver());
            
            $this->out();
            if ($this->_countSubdomains($subdomains)) {
                $this->out('Configuration Saved!', 2);
            } else {
                $this->err('Plugin Not Currently Active.', 2);    
            }
        }
    
    }
    
    private function _modifyArray (array $array) {

        return array_combine(range(1, count($array)), array_values($array)); ;    
        
    }
    
    
    private function _currentSubdomains (array $subdomains) {
        
        if ($this->_countSubdomains($subdomains)) {
            
            $this->out();
            $this->out('Current Subdomains:', 2);
                
            foreach ($subdomains AS $key => $value) {
                $this->out(' ' . ($key) . '. ' . $value);    
            }                
            
            $this->out();
        
        }
        
    }
    
    private function _askAddSubdomain () {
    
        return (strtolower($this->in('Add Subdomain?', ['y', 'n'])) === 'y');
        
    }
    
    private function _askDeleteSubdomain () {
    
        return (strtolower($this->in('Delete Subdomain?', ['y', 'n'])) === 'y');
        
    }
    
    /**
    * @param integer $key
    */
    private function _deleteSubdomain (&$subdomains, $key) {
        
        if (isset($subdomains[$key])) {
            
            $this->out();
            $this->out('Deleted: ' . $subdomains[$key], 2);
            unset($subdomains[$key]);
        
            return true; 
        
        }
        
        return false;
        
    }
    
    /**
    * @param string|null $subdomain
    */    
    private function _validateSubdomain ($subdomain) {
    
        if (is_null($subdomain) || empty($subdomain)) {
            return false;
        }
    
        return preg_match('/^[A-Za-z0-9]{1}(?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9]{1})?$/', $subdomain);
        
    }
    
    private function _askStartOver () {
        
        return (strtolower($this->in('Start Over?', ['y', 'n'])) === 'y');
        
    }
    
    private function _countSubdomains ($subdomains) {
        
        if (!is_array($subdomains) || is_null($subdomains)) {
            return false;                                
        }
        
        return (int) count($subdomains);        
        
    }
      
}