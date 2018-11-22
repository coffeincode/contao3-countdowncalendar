<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @package   CountdownCalendar
 * @author    Marina Diezler
 * @license   none
 * @copyright Coffeincode 2018
 */

/**
 * Namespace
 */



class ModuleCountdownCalendar extends ModuleCountdownDoor 
{
	/**
	 * Template
	 * @var string
	 */
        protected $strChildTable = "tl_countdown_door";
	protected $strTemplate = 'mod_ac_calendar'; 
        protected $strDetTemplate = 'ac_default';
        protected $acJumpTo='';
        
        public function generate()
	{
		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### Countdown-Calendar ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
                        if (!isset($_GET['item']) && Config::get('useAutoItem') && isset($_GET['auto_item'])) {
 
                             Input::setGet('item', Input::get('auto_item'));
 
                        }
                          
                        $this->strTemplate = $this->ac_details_template;
                        $acTpl = $this->ac_template; 
			return $objTemplate->parse();
		}
                
		return parent::generate();
	}
        
    
        
        
	/**
	 * Generate the module
         * 
         * 
	 */
	protected function compile()
	{ 
            
            $t = $this->strChildTable;
            
            $arrColumns = array("$t.pid", "$t.published");
            $arrValues = array("$this->ac_calendar", "1");
            $options = array('order'=>'sorting');
            $arrObj= CountdownDoorModel::findBy($arrColumns, $arrValues, $options);
            $arrObjSecrets= CountdownDoorModel::findBy($arrColumns, $arrValues, $options);
            $this->strDetTemplate = $this->ac_details_template;
            $this->strModTemplate = $this->ac_template;
            
            $arrObjCalendar = CountdownCalendarModel::findByIdOrAlias($this->ac_calendar);
           
            $this->Template->debug= $arrObjCalendar->acDebug;
            $debug=$arrObjCalendar->acDebug;
             $this->ac_jumpTo = $arrObjCalendar->jumpTo;
            $this->Template->setData($arrObjCalendar->row());
            $this->Template->message=NULL;
            //parse all doors:
            $arrObjCalendar->acDebug?$parsingDate=$arrObjCalendar->acDebugDate:$parsingDate=time();
            $acDoorList = $this->parseAllDoors($parsingDate,$this->ac_details_template, $arrObjSecrets); 
            $arrSecretsList = $this->parseAllSecrets($parsingDate,$this->ac_jumpTo,'default_secret', $arrObj);
            if ($acDoorList){
                  $this->Template->doorsList = $acDoorList;
                 $this->Template->secretsList = $arrSecretsList;
             }
             else {
                  //keine Tür verfügbar - leeren Kalender anzeigen 
                   $this->Template->doorsList = $this->Template->secretsList = NULL;
                   $this->Template->message = $GLOBALS['TL_LANG']['MSC']['ac_calendar_empty'];

                 
             }
             
            //compile and prepare calendar:
             if ($arrObjCalendar->singleSRC != '')
		{
                        $arrCal = $arrObjCalendar->row();
			$objImgModel = \FilesModel::findByUuid($arrObjCalendar->singleSRC);
			if ($objImgModel === null)
			{
				if (!\Validator::isUuid($arrObjCalendar->singleSRC))
				{
					$this->Template->text = '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
				}
			}
			elseif (is_file(TL_ROOT . '/' . $objImgModel->path))
			{
				
				$arrCal['singleSRC'] = $objImgModel->path;
                                
				$this->addImageToTemplate($this->Template, $arrCal);        
			}
		}
                
                //todo: add javascript
               // $GLOBALS['TL_JAVASCRIPT'][]='/system/modules/countdowncalendar/assets/ac_script.js';
                        
                //todo: add css
                  $GLOBALS['TL_CSS'][]='/system/modules/countdowncalendar/assets/styles.css';
           
	}
 
}
