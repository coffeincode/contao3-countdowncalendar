<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * Contao 3.5
 * @package   CountdownCalendar
 * @author    Marina Diezler
 * @license   none
 * @copyright Coffeincode 2018
 */


class ModuleCountdownDoorReader extends \ModuleCountdownDoor{
	/**
	 * Template
	 * @var string
	 */
	
        protected $objFiles;
        protected $strTemplate = 'mod_ac_door_reader';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### CountdownCalendar-Reader ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
                           
                        if (!isset($_GET['item']) && \Config::get('useAutoItem') && isset($_GET['auto_item'])) {
 
                             Input::setGet('item', Input::get('auto_item'));
 
                        }
			return $objTemplate->parse();
		}
                
                return parent::generate();
        }
	/**
	 * Generate the module
         * 
         * @global type $objPage
         */
           

        //todo: HIER muss die richtige funktion aufgerufen werden, die dann die Content-Elements der Tür parst!
	protected function compile()
	{    
           
            $objCalendarDoor = \CountdownDoorModel::findByIdOrAlias(\Input::get('auto_item'));
            if ($objCalendarDoor){
                if (\Contao\Input::get('debug')) {
                    $objCalendar = CountdownCalendarModel::findByIdOrAlias($objCalendarDoor->pid);
                    $arrCalendarDoor = $this->parseDoor($objCalendarDoor,$objCalendar->acDebugDate, 'ac_full');   
                }
                else $arrCalendarDoor = $this->parseDoor($objCalendarDoor,time(), 'ac_full');    
                //$arrMitarbeiter = $this->parseMA($objMitarbeiter, 'ma_default');

                $this->Template->acDetails = $arrCalendarDoor;
                $this->Template->referer = 'javascript:history.go(-1)';
                $this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];


            }
            
            else {//door not found -> show 404
                $objHandler = new $GLOBALS['TL_PTY']['error_404']();
                $objHandler->generate($objPage->id);
            }
         }
 
   
 
    
            
}
