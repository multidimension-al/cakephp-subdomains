# CakePHP Subdomain Routing

[![Build Status](https://api.travis-ci.org/multidimension-al/cakephp-subdomains.svg?branch=master)](https://travis-ci.org/multidimension-al/cakephp-subdomains)
[![Latest Stable Version](https://poser.pugx.org/multidimensional/cakephp-subdomains/v/stable.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)
[![Coverage Status](https://coveralls.io/repos/github/multidimension-al/cakephp-subdomains/badge.svg?branch=master)](https://coveralls.io/github/multidimension-al/cakephp-subdomains?branch=master)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/multidimensional/cakephp-subdomains/license.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)
[![Total Downloads](https://poser.pugx.org/multidimensional/cakephp-subdomains/d/total.svg)](https://packagist.org/packages/multidimensional/cakephp-subdomains)

Easily add sub domains to your CakePHP application using route prefixes. Based on [code](https://github.com/cakephp/cakephp/issues/7140) created by [chinpei215](https://github.com/chinpei215).

## Requirements

* CakePHP 3+
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