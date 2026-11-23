<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

// Switch PHP timezone to the logged-in branch's timezone (clock in/out, timesheets).
$hook['post_controller_constructor'][] = array(
	'class'    => 'Branch_timezone',
	'function' => 'apply',
	'filename' => 'Branch_timezone.php',
	'filepath' => 'hooks',
);
