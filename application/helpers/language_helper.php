<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function language($val = '', $kapital = '')
{
    $feedback = '';
    if ($val != '') {

        $feedback = $val;
        if ($kapital) {
            if ($kapital == 'first') {
                $feedback = ucfirst($val);
            } elseif ($kapital == 'allbig') {
                $feedback = strtoupper($val);
            } elseif ($kapital == 'allsmall') {
                $feedback = strtolower($val);
            } elseif ($kapital == 'firstbig') {
                $feedback = ucwords($val);
            }
        }
    }

    return $feedback;
}
