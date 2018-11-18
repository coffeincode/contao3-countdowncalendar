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

$strTable = 'tl_module';



$GLOBALS['TL_DCA'][$strTable]['palettes']['countdowncalendar'] = '{title_legend}, name,type,ac_calendar, ac_jumpTo, ac_template,ac_details_template,{expert_legend}, cssID, align, space';
$GLOBALS['TL_DCA'][$strTable]['palettes']['countdown_door_reader'] = '{title_legend}, name,type, ac_details_template, {expert_legend}, cssID, align, space';



$GLOBALS['TL_DCA'][$strTable]['fields']['ac_calendar']     = array
        (
                'inputType'                  =>'radio',
                'label'                      =>$GLOBALS['TL_LANG']['tl_module']['ac_display']['ac_calendar'],
                'options_callback'           => array('tl_module_cdcal','getCalendars'),
                'eval'                       => array('multiple'=>true,'submitOnChange'=>true, 'mandatory'=>true),             
                'sql'                        => "blob NULL"
        );

$GLOBALS['TL_DCA'][$strTable]['fields']['ac_jumpTo']        = array
	(
		'inputType'     => 'pageTree',
                'label'         => $GLOBALS['TL_LANG']['tl_module']['ac_display']['ac_jumpTo'],
                'eval'          => array('fieldType'=>'radio','tl_class' => 'clr'),
                'exclude'       => true,
                'foreignKey'    => 'tl_page.title',
                'sql'           => "int(10) unsigned NOT NULL default '0'",
                'relation'      => array('type'=>'hasOne', 'load'=>'eager')
        );

$GLOBALS['TL_DCA'][$strTable]['fields']['ac_template']        = array
        (
                'inputType' => 'select',
                'label'     => $GLOBALS['TL_LANG']['tl_module']['ac_display']['ac_template'],
                'eval'      => array('tl_class' => 'clr'),
                'exclude'   => true,
                'options_callback'        => array('tl_module_cdcal', 'getCdcModuleTemplates'),
                'sql'       => "varchar(64) NOT NULL default ''"

        );      
$GLOBALS['TL_DCA'][$strTable]['fields']['ac_details_template']        = array
        (
                'inputType' => 'select',
                'label'     => $GLOBALS['TL_LANG']['tl_module']['ac_display']['ac_details_template'],
                'eval'      => array('tl_class' => 'clr'),
                'exclude'   => true,
                'options_callback'        => array('tl_module_cdcal', 'getCdcTemplates'),
                'sql'       => "varchar(64) NOT NULL default ''"

        );      
       
class tl_module_cdcal extends \Backend {
    
    /**
	 * Return all Mitarbeiter-Element templates as array
	 *
	 * @return array
	 */
	public function getCdcTemplates()
	{
		return $this->getTemplateGroup('ac_');
	}
        
        public function getCdcModuleTemplates()
	{
		return $this->getTemplateGroup('mod_ac_');
	}
        public function getCalendars(){
            $arrCalendars = array();
            $objCalendars = $this->Database->execute("SELECT id, calendar_name FROM tl_countdowncalendar ORDER BY calendar_name");

            while ($objCalendars->next())
            {
	        $arrCalendars[$objCalendars->id] = $objCalendars->calendar_name;
            }

            return $arrCalendars;
        }
}