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
 * You should include this code AFTER all html output of your script
 *
 * usage:  require __DIR__ . '/ziling_footer.php';
 */
if ($_ziling_buffer_started) {
    require_once ZILING_ROOT . '/ziling_includes/ccharset.php';

    $RealOutput = ob_get_contents();

    $RealOutput .= '<!--  The content of this page is converted on the fly by Ziling Universal Chinese Encoding Conversion Tool by Wang Jue (alias wjue, http://www.wjue.org) Please do not remove this credit notice -->';

    ob_end_clean();

    $RealOutput .= '<br><br><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-3">Powered by <a href="http://www.wjue.org">Ziling v1.0 Copywrite Wang Jue (wjue)</a></font></div>';

    $code = new CCharset();

    if ('gb2312' == $c_lang) {
        $RealOutput = $code->Big5_Gb($RealOutput);
    }

    if ('big5' == $c_lang) {
        $RealOutput = $code->Gb_Big5($RealOutput);
    }

    if (!headers_sent()) {
        header('Content-Type:text/html; charset=' . $c_lang);
    }

    echo $RealOutput;
}
