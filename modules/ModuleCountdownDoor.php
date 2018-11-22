<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *Contao 3.5
 * @package   CountdownCalendar
 * @author    Marina Diezler
 * @license   none
 * @copyright Coffeincode 2018
 */


/**
 * Namespace
 */


abstract class ModuleCountdownDoor extends \Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strAcCeTemplate;
        protected $idReaderPage;
        
        /**
         * Function
         * Parses a single Calendar Door:
         * 
         * Every Calendar door has a teaser and a link to its reader-page with alias. 
         * As the calendar doors are put out in the order they are stored in the backend it is not clear if the actual door to be parsed is already openable or not. 
         * A locked door 
         * 
         * 
         */  
        protected function parseDoor ($objDoor, $strTimestamp, $strTemplate, $objReaderPage=null ){
            $objTemplate = new \FrontendTemplate($strTemplate);
	    $objTemplate->setData($objDoor->row());
	    $objTemplate->locked = true; //check this! A door is locked if the actual date of parsing is smaller than the active-timestamp of the door to be parsed. 
            $objTemplate->class = (($objDoor->cssClass != '') ? ' ' . $objDoor->cssClass : '') . $strClass;
            $objDoor->activeStart <= $strTimestamp ? $objTemplate->locked=false:$objTemplate->locked=true;
            
            if($objReaderPage){
                if(! $objTemplate->locked){
                    
                    $strLink= $this->makeLink($objReaderPage) . $objDoor->alias .'.html'; //@Todo': Variable für Erweiterung herausfinden! Steht in den Einstellungen oder in global objpage?! 
                    $objTemplate->link =$strLink;
                    $objTemplate->readerID = $objReaderPage->id;             
                }
                else {
                    $objTemplate->link ="#";
                    $objTemplate->teaser="";
                }
            }
            
            $id = $objDoor->id;
            $objTemplate->door_index=$objDoor->door_index;
            
            // generate anonymous functions for the text/content-elements which is only called in case the template parsed asks for it, see ModuleNews.php 
            $objTemplate->doorText = function () use ($id)
            {  
            	$strText = '';
                if (! $objTemplate->locked){
                    $objElement = \ContentModel::findPublishedByPidAndTable($id, 'tl_countdown_door');
                    if ($objElement !== null)
                    {
                        while ($objElement->next())
                        {
                            $strText .= $this->getContentElement($objElement->current());
                        }
                    }
                 } 
		return $strText;
            };
            
            $objTemplate->hasDoorText  = function () use ($objArticle)
            {
                if (! $objTemplate->locked) return \ContentModel::countPublishedByPidAndTable($objArticle->id, 'tl_countdown_door') > 0;
                else return false;
            };
              
            
            return $objTemplate->parse($objDoor);
        }
   
    protected function parseAllDoors ( $strTimestamp, $intTemplate, $arrDoors=null){    
        // $objTemplate = new \FrontendTemplate($this->ac_details_template);
         //$objTemplate =new \FrontendTemplate();
         if ($arrDoors === null){return null;}
         else {//das Array ist schonmal nicht leer
             $arrHelperDoors='';
             
             //zuerst die türen         
             while ($arrDoors->next()){
                 $arrHelperDoors .= $this->parseDoor($arrDoors,$strTimestamp, $intTemplate );
                 
             }
                          
             return $arrHelperDoors;
         }
     }   
     
      protected function parseAllSecrets( $strTimestamp, $objReaderPage, $intTemplate, $arrDoors=null){    
     
         if ($arrDoors === null){return null;}
         else {//das Array ist schonmal nicht leer
          
             $arrHelperSecrets='';
            
             //zuerst die türen         
             while ($arrDoors->next()){
               $arrHelperSecrets.= $this->parseDoor($arrDoors,$strTimestamp, 'default_secret',$objReaderPage);
             }
             
             return $arrHelperSecrets;
         }
     }   
     
        /**
     * Erstellt den Link zur Detailseite.
     * @param $intId
     * @return string
     * 
     * @todo Auto-Item und id-statt-alias hier berücksichtigen?
     * In ModuleNews.php in Zeile 372:
     * self::$arrUrlCache[$strCacheKey] = ampersand($objPage->getFrontendUrl(((\Config::get('useAutoItem') && !\Config::get('disableAlias')) ? '/' : '/items/') . ((!\Config::get('disableAlias') && $objItem->alias != '') ? $objItem->alias : $objItem->id)));
         * getFrontendUrl?! Wo ist das denn definiert?! 
     */
    private function makeLink($intId)
    {
        //global $objPage;
        $objPage = \Contao\PageModel::findByPk($intId);
 
        if ($objPage) {
            if(\Config::get('rewriteURL') && \Config::get('useAutoItem')&& !\Config::get('disableAutoAlias')){
                return $objPage->alias .'/';
            }
            else {    
                return '/index.php/'.$objPage->alias .'/';
            }
        }
 
        return '';
    }
}
