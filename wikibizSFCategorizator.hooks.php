<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 5/17/15
 * Time: 23:15
 */

class wikibizSFCategorizatorHooks {

    /**
     * @param DatabaseUpdater $updater
     */
    public static function onLoadExtensionSchemaUpdates( $updater ) {

        $updater->addExtensionTable('wikibiz_sf_categories', __DIR__.'/schema/wikibizSfCategories.sql' );

    }

    /**
     * @param SFFormPrinter $printer
     */
    public static function onsfFormPrinterSetup( $printer ) {

        $printer->registerInputType( 'SFKeywordsTokenInput' );
        return true;

    }

}