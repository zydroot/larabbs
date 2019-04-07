<?php


/**
 * 生成3rd_session
 * @param $len
 * @return bool|string
 */
function _3rd_session($len)
{

    $fp = @fopen('/dev/urandom', 'rb');

    $result = '';

    if ($fp !== FALSE) {

        $result .= @fread($fp, $len);

        @fclose($fp);

    } else {

        trigger_error('Can not open /dev/urandom.');

    }

    // convert from binary to string

    $result = base64_encode($result);

    // remove none url chars

    $result = strtr($result, '+/', '-_');


    return substr($result, 0, $len);

}
