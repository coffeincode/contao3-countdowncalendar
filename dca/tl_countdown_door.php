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
 * Table tl_countdown_door
 * 
 */

$strTable = 'tl_countdown_door';
$GLOBALS['TL_DCA'][$strTable] = array
(        
    'config' => array
	(
            'dataContainer'               => 'Table',
            'ptable'                      => 'tl_countdowncalendar',
	    'ctable'                      => array('tl_content'),
            'switchToEdit'                => true,
            'enableVersioning'            => true,
	    'sql' => array
            (
		'keys' => array
		(
                    'id' => 'primary',
                    'pid'       => 'index'
                   
		)
            )
	),

	// List
	'list' => array
	(
            'sorting' => array
            (
		'mode'                    => 4,
                'flag'                    =>11,
		'fields'                  => array('sorting'),
                'headerFields'            => array('id','calendar_name', 'calendar_start', 'calendar_stop'),
                'panelLayout'             => 'filter;search,limit',
		'child_record_callback'   => array('tl_countdown_door', 'listDoor'), 
		'child_record_class'      => 'no_padding'
            ),
            'global_operations' => array
            (
		'all' => array
                (
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
		)
            ),
            'operations' => array
            (
		'edit' => array
		(
                    'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['edit'],
                    'href'                => 'table=tl_content', // angelehnt an codefog, war im tl_mitarbeiter mal: => 'act=edit',
                    'icon'                => 'edit.gif'
		),
		'editheader' => array //das ist hier neu
		(
		        'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['editheader'],
		        'href'                => 'act=edit',
		        'icon'                => 'header.gif'
		    ),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
              
            'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'	=> array($strTable, 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_countdown_door']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
                       
		)
	),

	// Palettes
	'palettes' => array //Dies sind die Paletten die bei editheader kommen sollen
	(
		'__selector__'                => array('published'),
        'default'                     => '{door_legend},door_index,alias,activeStart,activeStop,door_title,door_subtitle,teaser,{publishing_legend}, published;{expert_legend},cssClass '
            
	),
        'subpalettes' => array
        (
            'published'     => 'start, stop'
        ),
	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        'pid' => array  //TODO in codefogs code ist nur noch sql, aber keine foreign-key oder relation definieriert... warum?
		(
			'foreignKey'              => 'tl_countdowncalendar.id',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
	    'sorting' => array
	    (
	        'sql'                     => "int(10) unsigned NOT NULL default '0'"
	    ),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
	    //todo: ist das jetzt nötig oder nicht?! 
	   'door_index' => array //todo: den Index aus dem Datum erzeugen
	    (
	        'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['door_index'],
	        'exclude'                 => true,
	        'inputType'               => 'text', //Todo darf das Text bleiben?
	        'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	        'sql'                     => "int(10) unsigned NOT NULL default '0'"
	    ),
	    'door_title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['door_title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'submitOnChange'=>true,'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'door_subtitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['door_subtitle'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255,'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback'          => array
                        (
                            array('tl_countdown_door', 'autoUpdateAlias')
                        ), 
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		),
        'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['teaser'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
                        'eval'                    => array('rte'=> 'tinyMCE','tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
        'cssClass' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['cssClass'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
            
        'published' => array// says whether a door is allowed to be parsed at all
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['published'],
			'exclude'                 => true,
                        'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'activeStart' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['activeStart'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'submitOnChange'=>true,'tl_class'=>'w50 wizard'),
            'save_callback'           => array (array($strTable, 'calcIndex')),
            'sql'                     => "varchar(10) NOT NULL default ''" 
            
        ),
        'activeStop' =>  array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_countdown_door']['activeStop'],
            'exclude'                 => true,
            'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
                )    
	)
);




class tl_countdown_door extends Backend{
  
   
    public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * returns whether a door has reached its date or not
	 * @param DataContainer
	 */
	public function isActive(DataContainer $dc){
	    $today = date();
	    if ($dc->activeStop<=$today){ //todo: macht NULL hier probleme?
	       
	        return false;
	        if ($dc->activeStart<=$today){
	            return true;
	        }
	    }
	    return false;
	}
		
	
	/*
	 * 
	 */
	public function calcIndex($varDateValue, DataContainer $dc){
	    // todo: take the actual activeStart and subtract the calendar's start-date, divide by 86400 and this +1 is the index. 
	    // needs to be called everytime the date is changed. 
	   // $objVersions = new \Versions('tl_countdown_door', $dc->activeRecord->id);
	   // $objVersions->initialize();
	    if ($varDateValue != $dc->activeRecord->activeStart){
	        $calendarStart = $this->Database->prepare("SELECT calendar_start FROM tl_countdowncalendar WHERE id=?")->execute($dc->activeRecord->pid)->fetchAssoc();
                if (version_compare(phpversion(), '7.0.0') >= 0) {
                    $offset = intdiv($varDateValue-$calendarStart['calendar_start'], 86400)+1;
                    System::log("PHP größer als oder gleich  7!",__METHOD__, TL_ERROR);
                }
                else {
                    System::log("PHP kleiner als 7!",__METHOD__, TL_ERROR);
                    $offset = floor(($varDateValue-$calendarStart['calendar_start'])/ 86400)+1;
                
                }
                if ($offset<=0) return false;
                System::log("Das offset ist d: ".$offset." tage ", __METHOD__, TL_GENERAL);
                System::log("Die timestamps lauten vardatevalue: ".$varDateValue.", calendarStart: ".$calendarStart['calendar_start'], __METHOD__, TL_GENERAL);
	        $this->Database->prepare("UPDATE tl_countdown_door SET door_index=".$offset." WHERE id=?")->execute($dc->activeRecord->id);
	    }
	    return $varDateValue;
	    
	}
	
    /**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	 public function toggleIcon($row, $href, $label, $title, $icon, $attributes)   {
             $this->import('BackendUser', 'User');

            if (strlen($this->Input->get('tid')))
            {
               $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
                $this->redirect($this->getReferer());
             }

             // Check permissions AFTER checking the tid, so hacking attempts are logged
             if (!$this->User->isAdmin && !$this->User->hasAccess('tl_countdown_door::published', 'alexf')) //Was ist 'alexf'?!
             {
                 return '';
             }

            $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];

             if (!$row['published'])
             {
                $icon = 'invisible.gif';
            }

            return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
        }
        /**
         * Toggle the visibility of an element
         * @param integer
         * @param boolean
        */
        public function toggleVisibility($intId, $blnPublished) {
            // Check permissions to publish
            if (!$this->User->isAdmin && !$this->User->hasAccess('tl_countdown_door::published', 'alexf')) {
                $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_example toggleVisibility', TL_ERROR);
                $this->redirect('contao/main.php?act=error');
            }

            $this->createInitialVersion('tl_countdown_door', $intId);

            // Trigger the save_callback
            if (is_array($GLOBALS['TL_DCA']['tl_countdown_door']['fields']['published']['save_callback'])) {
                foreach ($GLOBALS['TL_DCA']['tl_countdown_door']['fields']['published']['save_callback'] as $callback){
                    $this->import($callback[0]);
                    $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
                }
            }

            // Update the database
            $this->Database->prepare("UPDATE tl_countdown_door SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")->execute($intId);
            $this->createNewVersion('tl_countdown_door', $intId);
}

    public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;
                
		// Generate alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
                        $strHelper = 'Tag-'.$dc->activeRecord->door_index.'-'.$dc->activeRecord->door_title;
			$varValue = StringUtil::generateAlias($strHelper);
		}
                
		$objAlias = $this->Database->prepare("SELECT id FROM tl_countdown_door WHERE alias=?")->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
        
        
        /*
         * This function is called in case the index/ date is updated because in that case the calculated alias needs to be changed too. 
         * Reason: For an countdown-/ countdowncalendar it is reasonable to create readable aliases like .../day-7-this-is-the-headline.html
         * be careful: $varValue is 
         */
        public function autoUpdateAlias($varValue, DataContainer $dc)
	{
		
            $autoAlias = true;
            //get URL-Fragment
            $parentUrlFragment = $this->Database->prepare("Select urlFragment FROM tl_countdowncalendar WHERE id=?")->execute($dc->activeRecord->pid)->fetchAssoc();
            $urlFragment = $parentUrlFragment['urlFragment'];
            //create alias:
            $strHelper = $urlFragment.'-'.$dc->activeRecord->door_index.'-'.$dc->activeRecord->door_title;
            $varValue = StringUtil::generateAlias($strHelper);
	    
            
            $objAlias = $this->Database->prepare("SELECT id FROM tl_countdown_door WHERE alias=?")->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
        
        
    public function listDoor($arrRow)
	{
		return '<div class="tl_content_left"> Tür Nummer '.  $arrRow['door_index'] .': ' . $arrRow['door_title'] . ' </div>';
	}

}