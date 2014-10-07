<?php

/*
Plugin Name: Responsive Menu
Plugin URI: http://www.peterfeatherstone.com/wordpress/responsive-menu/
Description: Highly Customisable Responsive Menu Plugin Created By Peter Featherstone
Version: 2.1
Author: Peter Featherstone
Text Domain: responsive-menu
Author URI: http://www.peterfeatherstone.com/wordpress/responsive-menu/
License: GPL2
Tags: responsive, menu, responsive menu

    Copyright 2014  Peter Featherstone <hello@peterfeatherstone.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

Responsive Menu - A WordPress Responsive Menu Plugin

@package  WordPress Responsive Menu
@author   Peter Featherstone <hello@peterfeatherstone.com>

|--------------------------------------------------------------------------
| A note on Namespaces (or lack of)
|--------------------------------------------------------------------------
 
Unfortunately, due to ~70% non-support for NameSpaces all Classes are pre-fixed
with the RM_ tag to avoid conflict, will be updated to use Namespaces when and 
if it becomes a requirement for WordPress.

It's a bit ugly but it's the best way for compatibility with other plug-ins and 
all WordPress users.
 
 ****************
 * NOW LETS GO! ***--------------------------->
 ****************
 
|--------------------------------------------------------------------------
| Bootstrap The Application
|--------------------------------------------------------------------------
|
| This bootstraps the Responsive Menu and gets it ready for use, then it
| will load up the Responsive Menu application so that we can run it.
|
*/

require_once 'app/bootstrap.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can simply call the run method,
| which will setup everything we need to display the Responsive Menu 
| straight out the box with no extra customisation needed.
|
*/

$app->run();