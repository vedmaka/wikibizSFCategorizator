<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 5/17/15
 * Time: 23:16
 */

class wikibizSFCategorizatorSpecial extends UnlistedSpecialPage {

    function __construct()
    {
        parent::__construct('wikibizSFCategorizator');
    }


    public function execute()
    {

        $c = new wikibizSFCategorizator( Title::newMainPage() );
        $this->getOutput()->addHTML( print_r($c->getKeywords(),1) );

    }


}