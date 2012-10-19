<?php
/**
 *    This file is part of raiseTopOfTheShop module.
 *    
 *    SuperClix Export module is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    You can redistribute it and/or modify it under the terms of the 
 *    GNU General Public License as published by the Free Software Foundation, 
 *    either version 3 of the License, or (at your option) any later version.
 *
 *    See <http://www.gnu.org/licenses/>.
 *
 * @link http://www.oxid-esales.com
 */

class myArticleList extends myArticleList_parent
{
    public function loadTop5Articles()
    {
        //has module?
        $myConfig = $this->getConfig();

        if ( !$myConfig->getConfigParam( 'bl_perfLoadPriceForAddList' ) ) {
            $this->_blLoadPrice = false;
        }

        switch( $myConfig->getConfigParam( 'iTop5Mode' ) ) {
            case 0:
                // switched off, do nothing
                break;
            case 1:
                // manually entered
                $this->loadAktionArticles( 'oxtop5');
                break;
            case 2:
                $sArticleTable = getViewName('oxarticles');

                $sSelect  = "select * from $sArticleTable ";
                $sSelect .= "where ".$this->getBaseObject()->getSqlActiveSnippet()." and $sArticleTable.oxissearch = 1 ";
                $sSelect .= "and $sArticleTable.oxparentid = '' and $sArticleTable.oxsoldamount>0 ";
                $sSelect .= "order by $sArticleTable.oxsoldamount desc limit 6";

                $this->selectString($sSelect);
                break;
        }
    }
}