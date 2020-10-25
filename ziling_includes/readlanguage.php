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
 *  return detected accepted chinese charset of browser
 *  else return false
 */
function ReadLanguage()
{
    $langs = getenv('HTTP_ACCEPT_LANGUAGE');

    $tok = trim(strtok($langs, ','));

    while ($tok) {
        if (mb_strpos($tok, ';') > 0) {
            $tok = mb_substr($tok, 0, mb_strpos($tok, ';'));
        }

        $tok = mb_strtolower($tok);

        if (preg_match('/zh-tw/', $tok, $match)) {
            return ('big5');
        } elseif (preg_match('/zh-cn/', $tok, $match)) {
            return ('gb2312');
        } elseif (preg_match('/zh-hk/', $tok, $match)) {
            return ('big5');
        } elseif (preg_match('/zh-mo/', $tok, $match)) {
            return ('big5');
        } elseif (preg_match('/zh-sg/', $tok, $match)) {
            return ('gb2312');
        } elseif (preg_match('/zh/', $tok, $match)) {
            return ('gb2312');
        }
  

        return false;
    }

    return false;
}
