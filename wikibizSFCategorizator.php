<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 5/17/15
 * Time: 23:10
 */

if ( !defined( 'MEDIAWIKI' ) ) { exit( 1 ); }

$wgExtensionCredits['other'][] = array(
    'path'           => __FILE__,
    'name'           => 'SF Categorizator',
    'author'         => 'Jon Anderton',
    'version'        => '1.0',
    'url'            => 'https://www.mediawiki.org/wiki/',
    'descriptionmsg' => 'wikibizsfcategorizator-desc',
);

$wgMessagesDirs['wikibizSFCategorizator'] = __DIR__ . '/i18n';
$wgAutoloadClasses['wikibizSFCategorizator'] = __DIR__ . '/wikibizSFCategorizator.class.php';
$wgAutoloadClasses['wikibizSFCategorizatorHooks'] = __DIR__ . '/wikibizSFCategorizator.hooks.php';
$wgAutoloadClasses['wikibizSFCategorizatorSpecial'] = __DIR__ . '/wikibizSFCategorizator.special.php';

$wgSpecialPages['wikibizSFCategorizator'] = 'wikibizSFCategorizatorSpecial';


$wgHooks['LoadExtensionSchemaUpdates'][] = 'wikibizSFCategorizatorHooks::onLoadExtensionSchemaUpdates';