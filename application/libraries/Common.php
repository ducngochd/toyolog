<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {
	public function __construct()
	{
		
	}

	public function remakeSelectArr($targetArr, $seleted_value = null, $default = null)
    {

        $ret = array();
        foreach ($targetArr as $value => $label) {

            $selectStr = '';
            $checkStr = '';
            if ($value == $seleted_value) {
                $selectStr = 'selected="selected"';
                $checkStr  = 'checked="checked"';
            } elseif (empty($seleted_value) && $value == $default) {
                $selectStr = 'selected="selected"';
                $checkStr  = 'checked="checked"';
            }

            $ret[] = array('value'      => $value,
                           'label'      => $label,
                           'selected'   => $selectStr,
                           'checked'    => $checkStr
            );
        }
        return $ret;

    }
}