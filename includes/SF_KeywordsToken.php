<?php

class SFKeywordsTokenInput extends SFTokensInput {

    public static function getName()
    {
        return 'keywordstoken';
    }

    public static function getHTML( $cur_value, $input_name, $is_mandatory, $is_disabled, $other_args )
    {

        global $wgTitle;
        //First of all we should determine if this is editing of existing page

        $text = parent::getHTML($cur_value, $input_name, $is_mandatory, $is_disabled, $other_args);

        $add = '<b>teest</b>';

        return $add.$text;
    }


}