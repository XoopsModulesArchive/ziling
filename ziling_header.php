<?php

// ------------------------------------------------------------------------- //
//		Ziling Universal Chinese Language Encoding Conversion Tool  //
//				    Version:  2.00       			     		            //
//				   General Framework                                        //
//				<http://www.wjue.org>						                 //
// ------------------------------------------------------------------------- //
// Author: Wang Jue (alias wjue)   								  //
// Purpose: GB-BIG5 automatic conversion               	  //
// email:  wjue@wjue.org                                                     //
// URL: http://www.wjue.org                                              //
//      http://www.guanxiCRM.com                                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify	  //
//  it under the terms of the GNU General Public License as published by	  //
//  the Free Software Foundation; either version 2 of the License, or 	  //
//  (at your option) any later version. 							  //
//															  //
//  This program is distributed in the hope that it will be useful,		  //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of		  //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the		  //
//  GNU General Public License for more details.						  //
//

/**
 * Begin ziling_header.php
 *
 * You should include this code prior to ANY html output of your script
 *
 * usage:  require __DIR__ . '/ziling_header.php';
 */

// put here the absolute path dir of where you install Ziling, ex: '/www'

define('ZILING_ROOT', 'c:\\www\\wjueorg\\ziling');

// this is the default encoding of your website
// that is to say your native documents are in this encoding.
// In Continental China this is generally gb2312
// In Taiwan and Hong Kong this is probably big5

define('_DEFAULT_CHARSET', 'big5');

/**
 *  You need not change anything after this line
 */
$acceptedEncodingSet = ['big5', 'gb2312'];

require_once ZILING_ROOT . '/ziling_includes/readlanguage.php';

$_ziling_buffer_started = false;

global $c_lang, $HTTP_COOKIE_VARS;
if (isset($c_lang)) {
    $c_lang = mb_strtolower($c_lang);

    if (in_array($c_lang, $acceptedEncodingSet, true)) {
        setcookie('clang', mb_strtolower($c_lang), time() + 3600, '/');
    }
} else {
    $c_lang = mb_strtolower($HTTP_COOKIE_VARS['clang'] ?? ReadLanguage());
}

if (!$c_lang or !in_array($c_lang, $acceptedEncodingSet, true)) {
    $c_lang = mb_strtolower(_DEFAULT_CHARSET);
}
if (!headers_sent()) {
    header('Content-Type:text/html; charset=' . $c_lang);
}

if (_DEFAULT_CHARSET != $c_lang) {
    ob_start();

    $_ziling_buffer_started = true;
}
