<?php

class SFKeywordsTokenInput extends SFTokensInput {

    public static function getName()
    {
        return 'keywordstoken';
    }

    public static function getHTML( $cur_value, $input_name, $is_mandatory, $is_disabled, $other_args )
    {

        global $wgRequest, $wgOut;

        $wgOut->addModules('ext.wikibizSFCategorizator.main');

        $add = '';
        $text = parent::getHTML($cur_value, $input_name, $is_mandatory, $is_disabled, $other_args);

        //First of all we should determine if this is editing of existing page (VE only!)
        if( $wgRequest->getVal('target') && Title::newFromText( $wgRequest->getVal('target') )->exists() ) {
            //We are editing exiting page via form
            $sfc = new wikibizSFCategorizator( Title::newFromText( $wgRequest->getVal('target') ) );
            $add .= '<div class="wikibizSFKeywordsInput">';
            $add .= '<p>Please review list of keywords extracted from this page text below and select page categories based on your opinion:</p>';
            $add .= '<ul>';
            foreach( $sfc->getStat() as $keyword => $stat ) {
                $add .= '<li>'.$keyword.' <span>('.$stat.'%)</span></li>';
            }
            $add .= '</ul>';
            $add .= '</div>';
        }else{
            $add .= '<div class="wikibizSFKeywordsInput">';
            $add .= '<p>Please select page categories based on your opinion:</p>';
            $add .= '</div>';
        }

        return $add.$text;
    }


}