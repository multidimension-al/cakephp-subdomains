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

namespace Multidimensional\Subdomains\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Multidimensional\Subdomains\Middleware\SubdomainMiddleware;

class SubdomainsInstallShell extends Shell
{

    /**
     * @return void
     */
    public function main()
    {
        $this->clear();

        $this->helper('Multidimensional/Subdomains.Header')->output();

        $subdomains = $this->_getSubdomains();
        $continue = $this->_runProgram($subdomains);

        if ($continue) {
            do {
                $this->_inputSubdomain($subdomains);
                $this->_displayCurrentUniqueSubdomains($subdomains);
                $this->_deleteSubdomain($subdomains);
                $this->_writeConfig($subdomains);
                $this->_finalCheck($subdomains);
            } while (!$this->_countSubdomains($subdomains) && $this->_inputYesNo('Start over?'));
        }

        $this->_displayFinal($subdomains);
    }

    /**
     * @param array $subdomains
     * @return bool
     */
    private function _runProgram($subdomains)
    {
        if ($this->_countSubdomains($subdomains)) {
            return $this->_inputYesNo('Update configuration?');
        } else {
            return $this->_inputYesNo('Install subdomains plugin?');
        }
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _displayCurrentUniqueSubdomains(&$subdomains)
    {
        if ($this->_countSubdomains($subdomains)) {
            $subdomains = $this->_uniqueSubdomains($subdomains);
            $subdomains = $this->_modifyArray($subdomains);
            $this->_displayCurrentSubdomains($subdomains);
        }
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _inputSubdomain(&$subdomains)
    {
        $valid = true;
        $this->out();

        while (!$valid || $this->_inputYesNo('Add a subdomain?')) {
            $this->out();
            $subdomain = strtolower($this->in('Subdomain:'));
            $valid = $this->_validateSubdomain($subdomain);
            $this->out();

            if ($valid) {
                $subdomains[] = $subdomain;
            } else {
                $this->err('Invalid subdomain.');
            }
        };
    }

    /**
     * @param array $subdomains
     * @return array $subdomains
     */
    private function _uniqueSubdomains($subdomains)
    {
        if ($this->_countSubdomains($subdomains)) {
            return array_values(array_unique($subdomains));
        } else {
            return $subdomains;
        }
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _writeConfig($subdomains)
    {
        Configure::write('Multidimensional/Subdomains.Subdomains', array_values($subdomains));
        Configure::dump('subdomains', 'default', ['Multidimensional/Subdomains']);
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _displayFinal($subdomains)
    {
        $this->out();
        if ($this->_countSubdomains($subdomains)) {
            $this->out('Configuration saved!', 2);
        } else {
            $this->err('Plugin not currently active.', 2);
        }
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _finalCheck($subdomains)
    {
        if (!$this->_countSubdomains($subdomains)) {
            $this->out();
            $this->err('No subdomains configured.', 2);
        }
    }

    /**
     * @return SubdomainMiddleware
     */
    private function _getSubdomains()
    {
        $subdomainMiddleware = new SubdomainMiddleware();
        $subdomains = $subdomainMiddleware->getSubdomains();
        $defaultSubdomains = $subdomainMiddleware->defaultSubdomains;

        return array_diff($subdomains, $defaultSubdomains);
    }

    /**
     * @param array $subdomains
     * @return array
     */
    private function _modifyArray(array $subdomains)
    {
        if ($this->_countSubdomains($subdomains)) {
            return array_combine(
                range(1, count($subdomains)),
                array_values($subdomains)
            );
        } else {
            return $subdomains;
        }
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _displayCurrentSubdomains(array $subdomains)
    {
        if ($this->_countSubdomains($subdomains)) {
            $this->out();
            $this->out('Current subdomains:', 2);

            foreach ($subdomains as $key => $value) {
                $this->out(' ' . ($key) . '. ' . $value);
            }

            $this->out();
        }
    }

    /**
     * @param string $string
     * @return bool
     */
    private function _inputYesNo($string)
    {
        return strtolower($this->in($string, ['y', 'n'])) === 'y';
    }

    /**
     * @param array $subdomains
     * @return void
     */
    private function _deleteSubdomain(&$subdomains)
    {
        while ($this->_countSubdomains($subdomains) && $this->_inputYesNo('Delete a subdomain?')) {
            $this->out();
            $key = (int)$this->in('Enter number to delete:', array_keys($subdomains));

            if (isset($subdomains[$key])) {
                $this->out();
                $this->out('Deleted: ' . $subdomains[$key], 2);
                unset($subdomains[$key]);
            }
        }
    }

    /**
     * @param  string|null $subdomain
     * @return string|null
     */
    private function _validateSubdomain($subdomain)
    {
        if (is_null($subdomain) || empty($subdomain)) {
            return false;
        }

        return preg_match('/^[A-Za-z0-9]{1}(?:[A-Za-z0-9\-]{0,61}[A-Za-z0-9]{1})?$/', $subdomain);
    }

    /**
     * @param  array $subdomains
     * @return int
     */
    private function _countSubdomains($subdomains)
    {
        if (!isset($subdomains) || !is_array($subdomains)) {
            return 0;
        }

        return count($subdomains);
    }
}
