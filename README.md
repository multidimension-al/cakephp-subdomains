# CakePHP Subdomain Routing

[![Build Status](https://api.travis-ci.org/multidimension-al/cakephp-subdomains.svg?branch=master)](https://travis-ci.org/multidimension-al/cakephp-subdomains)
[![Latest Stable Version](https://poser.pugx.org/multidimensional/cakephp-subdomains/v/stable.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/multidimensional/cakephp-subdomains/license.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)
[![Total Downloads](https://poser.pugx.org/multidimensional/cakephp-subdomains/d/total.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/multidimension-al/cakephp-subdomains/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/multidimension-al/cakephp-subdomains/?branch=master)

Easily add sub domains to your CakePHP application using route prefixes. Based on [code](https://github.com/cakephp/cakephp/issues/7140) created by [chinpei215](https://github.com/chinpei215).

## Requirements

* CakePHP 3.3+
* PHP 5.5.9+

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require --prefer-dist multidimensional/cakephp-subdomains
```

## Setup


Load the plugin by running following command in terminal:

```
bin/cake plugin load Multidimensional/Subdomains -b -r
```

Or by manually adding following line to your app's `config/bootstrap.php`:

```php
Plugin::load('Multidimensional/Subdomains', ['bootstrap' => true, 'routes' => true]);
```

## Configuration

Run the installation script command in termainl:

```
bin/cake SubdomainsInstall
```

This command will allow you to automatically create a configuration file with the list of your subdomains for the plugin to use. You can also run this command to add or delete additional subdomains.

Alternatively, you can create a `config/subdomains.php` file in your main CakePHP config folder:

```php
return array(
    'Multidimensional/Subdomains' => 
        array('subdomains' =>
			array('{SUBDOMAIN_1}', '{SUBDOMAIN_2}', /*...*/ '{SUBDOMAIN_N}')
		)
	);
```

## Usage

The plugin will automatically add the subdomains you specify as CakePHP prefixes. 

When generating links, include the subdomain prefix you want to use and the Router will automatically create the link using the subdomain URL.

```php
//Link to http://example.com/articles/
$this->Html->link(['prefix'=>false, 'controller'=>'Articles', 'action'=>'index']);

//Link to http://admin.example.com/articles/
$this->Html->link(['prefix'=>'admin', 'controller'=>'Articles', 'action'=>'index']);
```

## Contributing

Please help our project by creating a fork, and sending a pull request.

We need help writing unit tests, implementing Travis-CI and generally improving the functionality of the code.

## License

    The MIT License (MIT)

    Copyright (c) 2016 multidimension.al
	
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
