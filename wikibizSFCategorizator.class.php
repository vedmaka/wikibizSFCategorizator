<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 5/17/15
 * Time: 23:14
 */

class wikibizSFCategorizator {

    /**
     * @var Title
     */
    private $mTitle;

    /**
     * @var string[]
     */
    private $mKeywords;

    /**
     * @var int
     */
    private $mLimit;

    /**
     * @var int
     */
    private $mKeywordMinLength;

    /**
     * @var string
     */
    private $mCleanText;

    /**
     * @var array[]
     */
    private $mStat;

    /**
     * @param Title $title
     */
    function __construct( $title, $limit = 10, $minLen = 3 )
    {
        $this->mTitle = $title;
        $this->mKeywords = array();
        $this->mLimit = $limit;
        $this->mKeywordMinLength = $minLen;
        $this->extract();
    }

    public function getKeywords() {
        return $this->mKeywords;
    }

    private function extract() {

        global $wgParser;

        $wp = WikiPage::newFromID($this->mTitle->getArticleID());
        if( $wp ) {
            //Get parsed page text
            $text = $wgParser->parse($wp->getContent()->getWikitextForTransclusion(), $this->mTitle, new ParserOptions())->getText();
            //Clean it
            $stripped = html_entity_decode( $text, ENT_QUOTES, "utf-8" );
            $stripped = strip_tags($stripped);
            $stripped = preg_replace('/[^a-zA-Z\-0-9\s]/', '', $stripped);
            $stripped = str_replace("\n", ' ', $stripped);
            $this->mCleanText = $stripped;
            //Break into tags
            $keywords = explode(" ", $stripped);
            $keywords = array_filter($keywords, array($this,'filterArray') );
            $keywords = array_unique( $keywords );
            if( $this->mLimit ) {
                $keywords = array_slice( $keywords, 0, $this->mLimit );
            }
            $this->mKeywords = $keywords;
        }

        return false;

    }

    public function getStat() {

        $stat = array();
        foreach( $this->mKeywords as $keyword ) {
            $stat[ $keyword ] = substr_count( $this->mCleanText, $keyword );
        }
        uasort($stat, array($this, 'sortArray'));
        $this->mStat = $stat;
        return $this->mStat;

    }

    private function sortArray( $a, $b ) {
        if( $a > $b ) {
            return false;
        }else{
            return true;
        }
    }

    private function filterArray( &$item ) {
        if( strlen($item) > $this->mKeywordMinLength ) {
            $item = mb_strtolower($item);
            return true;
        }
        return false;
    }

}