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
    
    public function main() {
        
        $this->clear();
        
        $this->helper('Multidimensional/Subdomains.Header')->output();
    
        $subdomains = $this->_getSubdomains();    
            
        if ($this->_countSubdomains($subdomains)) {
            $continue = $this->_askInstall();
        } else {
            $continue = $this->_askUpdate();
        }
                  
        if ($continue) {
            
            do {
                
                $addMore = true;
                
                if ($this->_countSubdomains($subdomains)) {
                    $this->_displayCurrentUniqueSubdomains($subdomains);
                    $addMore = $this->_askAddSubdomain();              
                }
                
                if ($addMore) {
                        
                    if (!$this->_countSubdomains($subdomains)) {
                        $this->out();
                        $this->out('Add your first subdomain.');
                    }
                        
                    do {
                        
                        $this->out();
                        $subdomain = $this->_inputSubdomain();
                        $valid = $this->_validateSubdomain($subdomain);
                        $this->out();
                        
                        if ($valid) {
                            $subdomains[] = $subdomain;
                        } else {
                            $this->err('Invalid subdomain.');
                        }
                        
                    } while (!$valid || $this->_askAddSubdomain());
                    
                }
                
                $this->_displayCurrentUniqueSubdomains($subdomains);
                            
                while ($this->_countSubdomains($subdomains) && $this->_askDeleteSubdomain()) {
                    $deleteKey = $this->_inputDeleteSubdomain($subdomains);
                    $this->_deleteSubdomain($subdomains, $deleteKey);
                }
                
                $this->_writeConfig($subdomains);
                $this->_finalCheck($subdomains);
                
            } while (!$this->_countSubdomains($subdomains) && $this->_askStartOver());
            
            $this->_displayFinal($subdomains);

        }
    
    }
    
    private function _displayCurrentUniqueSubdomains(&$subdomains) {
        
        $subdomains = $this->_uniqueSubdomains($subdomains);
        $subdomains = $this->_modifyArray($subdomains);
        $this->_displayCurrentSubdomains($subdomains);
        
    }
        
    private function _uniqueSubdomains($subdomains) {
        
        return array_values(array_unique($subdomains));
        
    }
    
    private function _inputSubdomain() {
        
        return $this->in('Subdomain:');
        
    }
    
    private function _inputDeleteSubdomain($subdomains) {
        
        $this->out();
        return (int) $this->in('Enter number to delete:', array_keys($subdomains));    
            
    }
    
    private function _writeConfig($subdomains) {
        
        Configure::write('Multidimensional/Subdomains.subdomains', array_values($subdomains));
        Configure::dump('subdomains', 'default', ['Multidimensional/Subdomains']);    
        
    }
    
    private function _displayFinal($subdomains) {
    
        $this->out();
        if ($this->_countSubdomains($subdomains)) {
            $this->out('Configuration saved!', 2);
        } else {
            $this->err('Plugin not currently active.', 2);    
        }
        
    }
    
    private function _finalCheck($subdomains) {
    
        if (!$this->_countSubdomains($subdomains)) {
            $this->out();
            $this->err('No subdomains configured.', 2);                    
        }    
        
    }
    
    private function _getSubdomains() {
    
        $check = Configure::check('Multidimensional/Subdomains.subdomains');
        
        if (!$check) {
            return false;    
        }
        
        $subdomains = Configure::consume('Multidimensional/Subdomains.subdomains');
        
        if ($this->_countSubdomains($subdomains)) {
            return $subdomains;
        }
        
        return false;
        
    }
    
    private function _modifyArray(array $array) {

        return array_combine(range(1, count($array)), array_values($array)); ;    
        
    }
    
    
    private function _displayCurrentSubdomains(array $subdomains) {
        
        if ($this->_countSubdomains($subdomains)) {
            
            $this->out();
            $this->out('Current subdomains:', 2);
                
            foreach ($subdomains AS $key => $value) {
                $this->out(' ' . ($key) . '. ' . $value);    
            }                
            
            $this->out();
        
        }
        
    }
    
    private function _askInstall() {
        
        return strtolower($this->in('Install subdomains plugin?', ['y', 'n'])) === 'y';
        
    }
    
    private function _askUpdate() {
            
        return strtolower($this->in('Update configuration?', ['y', 'n'])) === 'y';
            
    }

    private function _askAddSubdomain() {
    
        return strtolower($this->in('Add a subdomain?', ['y', 'n'])) === 'y';
        
    }
    
    private function _askDeleteSubdomain() {
    
        return strtolower($this->in('Delete a subdomain?', ['y', 'n'])) === 'y';
        
    }
    
    /**
     * @param integer $key
     */
    private function _deleteSubdomain(&$subdomains, $key) {
        
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
    private function _validateSubdomain($subdomain) {
    
        if (is_null($subdomain) || empty($subdomain)) {
            return false;
        }
    
        return preg_match('/^[A-Za-z0-9]{1}(?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9]{1})?$/', $subdomain);
        
    }
    
    private function _askStartOver() {
        
        return strtolower($this->in('Start over?', ['y', 'n'])) === 'y';
        
    }
    
    private function _countSubdomains($subdomains) {
        
        if (!is_array($subdomains)) {
            return false;                                
        }
        
        if (is_null($subdomains)) {
            return false;    
        }
        
        if (count($subdomains) === 0) {
            return false;
        }
        
        return (int) count($subdomains);        
        
    }
      
}