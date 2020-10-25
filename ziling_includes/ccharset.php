<?php
// ------------------------------------------------------------------------- //
//		Chinese Language Encoding Conversion Tool  Ziling                   //
//				    Version:  1.10       			     		            //
//				   General Framework                                        //
//				<http://www.wjue.org>						                 //
// ------------------------------------------------------------------------- //
// Author: Wang Jue (alias wjue)   								  //
// Purpose: GB<->BIG5 automatic conversion               	  //
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

if (!defined('ZILING_C_CCHARSET_INCLUDED')) {
    define('ZILING_C_CCHARSET_INCLUDED', 1);

    class CCharset
    {
        public $gb_map;

        public $big5_map;

        public $dep_char = 127;

        public function __construct()
        {
            $this->gb_map = ZILING_ROOT . '/ziling_includes/gb.map';

            $this->big5_map = ZILING_ROOT . '/ziling_includes/big5.map';
        }

        //-----------------------------------------------------------------

        public function cbig5_gb($str, $fd)
        {
            $c = ord(mb_substr($str, 0, 1));

            $x = ord(mb_substr($str, 1, 1));

            $address = (($c - 160) * 510) + ($x - 1) * 2;

            fseek($fd, $address);

            $hi = fgetc($fd);

            $lo = fgetc($fd);

            return "$hi$lo";
        }

        public function cgb_big5($str, $fd)
        {
            $c = ord(mb_substr($str, 0, 1));

            $x = ord(mb_substr($str, 1, 1));

            $address = (($c - 160) * 510) + ($x - 1) * 2;

            fseek($fd, $address);

            $hi = fgetc($fd);

            $lo = fgetc($fd);

            return "$hi$lo";
        }

        //-----------------------------------------------------------------

        public function Big5_Gb($str)
        {
            $fd = fopen($this->gb_map, 'rb');

            $search = ['/charset=big5/i', '/lang="tw"/i', '/content="tw"/i', '/encoding="big5"/i'];

            $replace = ['charset=gb2312', 'lang="cn"', 'content="cn"', 'encoding="gb2312"'];

            $str = preg_replace($search, $replace, $str);

            $outstr = '';

            for ($i = 0, $iMax = mb_strlen($str); $i < $iMax; $i++) {
                $ch = ord(mb_substr($str, $i, 1));

                if ($ch > $this->dep_char) {
                    $outstr .= $this->cbig5_gb(mb_substr($str, $i, 2), $fd);

                    $i++;
                } else {
                    $outstr .= mb_substr($str, $i, 1);
                }
            }

            fclose($fd);

            return $outstr;
        }

        //-----------------------------------------------------------------

        public function Gb_Big5($str)
        {
            $fd = fopen($this->big5_map, 'rb');

            $search = ['/charset=gb2312/i', '/charset=gbk/i', '/lang="cn"/i', '/content="cn"/i', '/encoding="gb2312"/i'];

            $replace = ['charset=big5', 'charset=big5', 'lang="tw"', 'content="tw"', 'encoding="big5"'];

            $str = preg_replace($search, $replace, $str);

            $outstr = '';

            for ($i = 0, $iMax = mb_strlen($str); $i < $iMax; $i++) {
                $ch = ord(mb_substr($str, $i, 1));

                if ($ch > $this->dep_char) {
                    $outstr .= $this->cgb_big5(mb_substr($str, $i, 2), $fd);

                    $i++;
                } else {
                    $outstr .= mb_substr($str, $i, 1);
                }
            }

            fclose($fd);

            return $outstr;
        }
    }
}
