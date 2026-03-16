<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array();
$config['useragent']           = "CodeIgniter";
$config['mailpath']            = "/usr/sbin/sendmail";
$config['protocol']            = "smtp";
$config['smtp_host']           = "smtp.gmail.com";
$config['smtp_port']           = "587";
$config['mailtype'] = 'html';
$config['smtp_timeout']=30;
$config['smtp_crypto'] = 'tls';
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
$config['wordwrap'] = TRUE;