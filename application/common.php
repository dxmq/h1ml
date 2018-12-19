<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// span 替换为 a
function replace($html) {
    return str_replace('span', 'a', $html);
}

/**
 * 中文截取无乱码
 * 下面自定义一个函数实现中文截取无乱码,由于中文字符是多字节编码实现的,所以
 * 在截取的时候不仅要知道从哪里开始截取还要知道截取几个字节,在这一点上utf-8
 * 实现的比较好,这种编码可以通过最高位字节来区分该字符占几个字节的编码
 *
 * UTF-8（8-bit Unicode Transformation Format）是一种针对Unicode的可变长度字符编码,由Ken Thompson于1992年创建。
 *
 * 通过查询相关资料可知:
 * utf-8最高位字节与该字符所占字节数有以下对应关系
 * 0xxx xxxx        占1字节
 * 110x xxxx        占2字节
 * 1110 xxxx        占3字节
 * 一般三个字节能够表示所有汉字对应编码
 */
/**
 * @param  str   $str    被截取的字符串
 * @param  int   $length 需要截取长度，即需要截取的字符个数
 */
function mulsubstr($str,$length){
    if($length<=0){    //截取字符为0或负数，返回空字符串
        return '';
    }
    $offset=0;  //截取每个字符时最高位字节的偏移量(位置),开始的时候截取第一个字符，该字符最高位字节位置为0
    $chars=0;  //已经截取到的字符，开始时为0
    $returnstr='';  //截取后返回的字符串
    while($chars<$length){  //只要已经截取到的字符没有达到需要截取的就继续截取
        $highchar=  decbin(ord(substr($str, $offset,1))); //得到每个字符最高位字节编码字符,根据该编码字符判断向后截取几个字节
        if(strlen($highchar)<8){ //该字符占一个字节时，按照上面的规律，返回字符编码二进制为0xxx xxxx的字符串形式,转为二进制时开头的0会舍弃，该字节就只有7位了,
            //若此处使用if(substr($highchar,0,2)=='01'),则该判断永远不会生效,因为在decbin时最高位字节为0会舍去,这样就可以使用最高位字节长度来判断了,这点需要重点理解。
            $cutbyte=1;//
        }else if(substr($highchar,0,3)== '110'){
            $cutbyte=2;
        }else if(substr($highchar, 0,4)== '1110'){
            $cutbyte=3;
        }else if(substr($highchar,0,5)=='11110'){
            $cutbyte=4;
        }
        //判断完对应字符编码所占字节后开始截取并拼接
        $returnstr.=substr($str,$offset,$cutbyte);
        $chars+=1;  //继续截取下一个字符
        $offset+=$cutbyte;  //下一个字符最高字节偏移量
    }
    return $returnstr;  //返回需要截取的字符串
}
