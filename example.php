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
 *  Example File
 */
if (isset($delcookie)) {
    delete_cookie();

    header('Location: example.php', true);
}
// include Ziling header first

require_once __DIR__ . '/ziling_header_ex.php';

/**
 *  now we can make some html output
 */
echo '<br> 歡迎訪問 wjue 的致命墜落網站  <a href=http://www.wjue.org>http://www.wjue.org</a><br> ';

echo '<br><a href=example.php?c_lang=gb2312>GB2312</a> | <a href=example.php?c_lang=big5>BIG5</a> | <a href=example.php?delcookie=1>Delete Cookie</a>';

echo '<br><br>--------------------------------<br>Ziling Test Program by <a href=http://www.wjue.org>Wang Jue (wjue)</a>';
require_once __DIR__ . '/ziling_footer.php';

function delete_cookie()
{
    if (!headers_sent()) {
        // set the expiration date to ten hour ago

        setcookie('clang', '', time() - 36000, '/');
    }
}
