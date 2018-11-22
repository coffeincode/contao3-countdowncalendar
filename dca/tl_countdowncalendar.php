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
 * Table tl_countdowncalendar
 * 
 */

$strTable = 'tl_countdowncalendar';
$GLOBALS['TL_DCA'][$strTable] = array
(        
        'config' => array
	(
            'dataContainer'               => 'Table',
            'ctable'                      => array('tl_countdown_door'),
            'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
                        'fields'                  => array('calendar_name'), 			
			'flag'                    => 1,
                        'panelLayout'             => 'search,limit'
		),
		'label' => array
		(
			'fields'                  => array('calendar_name'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select', 
				'class'               => 'header_edit_all',  
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array //soll zu den einzelnen Tagen eines Kalenders führen 
			(
				'label'               => &$GLOBALS['TL_LANG'][$strTable]['edit'],
				'href'                => 'table=tl_countdown_door',
				'icon'                => 'edit.gif'
			),
                        'editheader' => array  //soll zu den Basiseinstellungen des KAlenders führen
			(
				'label'               => &$GLOBALS['TL_LANG'][$strTable]['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_countdowncalendar', 'editHeader')
			),
                    'copy' => array
                    (
                        'label'               => &$GLOBALS['TL_LANG'][$strTable]['copy'],
                        'href'                => 'act=copy',
                        'icon'                => 'copy.gif'
                    ),
                    'delete' => array
                    (
                        'label'               => &$GLOBALS['TL_LANG'][$strTable]['delete'],
                        'href'                => 'act=delete',
                        'icon'                => 'delete.gif',
                        'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"' 
                    ),
                    'toggle' => array
                    (
                        'label'               => &$GLOBALS['TL_LANG'][$strTable]['toggle'],
                        'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                        'button_callback'	=> array($strTable, 'toggleIcon')
                    ),
                    'show' => array
                    (
                        'label'               => &$GLOBALS['TL_LANG'][$strTable]['show'],
                        'href'                => 'act=show',
                        'icon'                => 'show.gif'
                    )    
                )
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),
  
	// Palettes
	'palettes' => array
	(
	    '__selector__'                => array('acDebug', 'addOverlay'),
            'default'                     => '{title_legend:show},calendar_name, calendar_start, 
                                               calendar_stop, 
                                               jumpTo,
                                               urlFragment;
                                             {debug_legend:hide},
                                               acDebug;
                                             {cc_layout_legend},
                                                singleSRC,
                                                alt, 
                                                size,
                                                addOverlay,
                                                showGoneDates,
                                                doorsPerRowLG,
                                                doorsPerRowMD,
                                                doorsPerRowXS,
                                                breakpointMD,
                                                breakpointXS,
                                                addImage,
                                                doorBgColor, 
                                                doorFontColor,
                                                doorSecretBgColor,
                                                doorSecretFontColor,
                                                popSecretButtonBgColor,
                                                popSecretButtonFontColor,
                                                popSecretBgColor,
                                                popSecretFontColor,                            
                                                
                                            '
	),
    'subpalettes' => array
    (
        'acDebug'       => 'acDebugDate', 
        'addOverlay'    => 'overlayType,overlayColor'
    ),
	// Fields
	'fields' => array
	(
            'id' => array
            (
                'sql'                     => "int(10) unsigned NOT NULL auto_increment"
            ),
            'tstamp' => array
            (
            	'sql'                     => "int(10) unsigned NOT NULL default '0'"
            ),
            'calendar_name' => array
            (
                'label'                   => &$GLOBALS['TL_LANG'][$strTable]['calendar_name'],
                'exclude'                 => true,
                'search'                  => true,
		'inputType'               => 'text',
		'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
		'sql'                     => "varchar(255) NOT NULL default ''"
            ),
	    'calendar_start' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['calendar_start'],
	        'exclude'                 => true,
	        'search'                  => true,
	        'inputType'               => 'text',
	        'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50'), 
                'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
	    'calendar_stop' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['calendar_stop'],
	        'exclude'                 => true,
	        'search'                  => true,
	        'inputType'               => 'text',
	        'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 clr'),
	        'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
            'urlFragment' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['urlFragment'],
	        'exclude'                 => true,
	        'search'                  => true,
	        'inputType'               => 'text',
	        'eval'                    => array('mandatory'=>'true'),
	        'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
            'acDebug' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['acDebug'],
	        'exclude'                 => true,
	        'inputType'               => 'checkbox',
                'eval'                    => array('submitOnChange'=>true, ),
	        'sql'                     => "char(1) NOT NULL default ''"
	    ),
            'acDebugDate' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['acDebugDate'],
	        'exclude'                 => true,
	        'inputType'               => 'text',
                'eval'                    => array('rgxp'=>'date', 'datepicker'=>true,'mandatory'=>true, 'tl_class'=>'w50 clr m12'),
	        'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
	    'showGoneDates' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['showGoneDates'],
	        'exclude'                 => true,
	        'inputType'               => 'checkbox',
	        'sql'                     => "char(1) NOT NULL default ''",
                'eval'                    => array('tl_class'=>'w50 clr ')
	    ),
            'doorsPerRowLG' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorsPerRowLG'],
	        'exclude'                 => true,
	        'inputType'               => 'select',
	        'options'                 => array('10','9','8','7','6','5','4','3'),
	        'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	        'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'tl_class'=>'w50 clr '),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'doorsPerRowMD' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorsPerRowMD'],
	        'exclude'                 => true,
	        'inputType'               => 'select',
	        'options'                 => array('10','9','8','7','6','5','4','3'),
	        'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	        'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'doorsPerRowXS' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorsPerRowXS'],
	        'exclude'                 => true,
	        'inputType'               => 'select',
	        'options'                 => array('10','9','8','7','6','5','4','3','2','1'),
	        'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	        'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true,  'tl_class'=>'w50 clr'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'breakpointMD' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['breakpointMD'],
	        'exclude'                 => true,
	        'search'                  => true,
	        'inputType'               => 'text',
	        'eval'                    => array('mandatory'=>'true', 'nospace'=>true,  'tl_class'=>'w50 clr'),
	        'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
            'breakpointXS' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['breakpointXS'],
	        'exclude'                 => true,
	        'search'                  => true,
	        'inputType'               => 'text',
	        'eval'                    => array('mandatory'=>'true','tl_class'=>'w50 clr'),
	        'sql'                     => "varchar(10) NOT NULL default ''"
	    ),
	    
	    'singleSRC' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['singleSRC'],
	        'exclude'                 => true,
	        'inputType'               => 'fileTree',
	        'eval'                    => array('filesOnly'=>true, 'extensions'=>Config::get('validImageTypes'), 'fieldType'=>'radio', 'mandatory'=>true),
	        'save_callback'           => array (array($strTable, 'storeFileMetaInformation')	),
	        'sql'                     => "binary(16) NULL"
	    ),
	    'size' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['size'],
	        'exclude'                 => true,
	        'inputType'               => 'imageSize',
	        'options'                 => \Contao\System::getImageSizes(),
	        'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	        'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
	    'addOverlay' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['addOverlay'],
	        'exclude'                 => true,
	        'inputType'               => 'checkbox',
	        'eval'                    => array('submitOnChange'=>true, ),
	        'sql'                     => "char(1) NOT NULL default ''"
	    ),
            'overlayColor' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['overlayColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'overlayType' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['overlayType'],
	        'exclude'                 => true,
	        'inputType'               => 'select',
                 'eval'                   => array('includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50 clr'),
	        'options'                 => array('normal','multiply','screen', 'overlay', 'darken', 'lighten', 'color-dodge','color-burn', 'hard-light', 'soft-light', 'difference', 'exclusion', 'hue', 'saturation', 'color', 'luminosity'),
	        'sql'                     => "char(1) NOT NULL default ''"
	    ),
            'doorBgColor' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorBgColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'doorFontColor' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorFontColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'doorSecretBgColor' => array  //door zooming in background color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorSecretBgColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            
            'doorSecretFontColor' => array //door zooming in font color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['doorSecretFontColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'popSecretButtonBgColor' => array //door zooming in font color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['popSecretButtonBgColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            'popSecretButtonFontColor' => array //door zooming in font color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['popSecretButtonFontColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
            
            'popSecretBgColor' => array //door zooming in font color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['popSecretBgColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
              'popSecretFontColor' => array //door zooming in font color
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['popSecretFontColor'],
	        'exclude'                 => true,
	        'inputType'               => 'text', 
                'colorpicker'             => true,
                'eval'                    => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
	        'sql'                     => "varchar(64) NOT NULL default ''"
	    ),
	    'svgSprites' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['svgSprites'],
	        'exclude'                 => true,
	        'inputType'               => 'fileTree',
	        'eval'                    => array('filesOnly'=>true, 'extensions'=>Config::get('validImageTypes'), 'fieldType'=>'radio'), //todo validtypes auf svg setzen!
	        'save_callback'           => array (array($strTable, 'storeFileMetaInformation')),
	        'sql'                     => "binary(16) NULL"
	    ),
	    'jumpTo' => array(
	        'inputType'     => 'pageTree',
	        'label'         => &$GLOBALS['TL_LANG'][$strTable]['jumpTo'],
	        'eval'          => array('mandatory'=>'false', 'fieldType'=>'radio','tl_class' => 'clr'),
	        'exclude'       => true,
	        'foreignKey'    => 'tl_page.title',
	        'sql'           => "int(10) unsigned NOT NULL default '0'",
	        'relation'      => array('type'=>'hasOne', 'load'=>'eager')
	    ),
	    'jsTemplate' => array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['jsTemplate'],
	        'exclude'                 => true,
	        'inputType'               => 'fileTree',
	        'eval'                    => array('filesOnly'=>true, 'extensions'=>Config::get('validImageTypes'), 'fieldType'=>'radio'), //todo validtypes auf svg setzen!
	        'save_callback'           => array (array($strTable, 'storeFileMetaInformation')	),
	        'sql'                     => "binary(16) NULL"
	    ),
'published'=> array
	    (
	        'label'                   => &$GLOBALS['TL_LANG'][$strTable]['published'],
	        'exclude'                 => true,
	        'filter'                  => true,
	        'flag'                    => 1,
	        'inputType'               => 'checkbox',
	        'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true),
	        'sql'                     => "char(1) NOT NULL default ''"
	    ),
	

	)
);




class tl_countdowncalendar extends Backend{
  
    
    /**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
/**
	 * Return the edit header button
	 *
	 * @param array  $row
	 * @param string $href
	 * @param string $label
	 * @param string $title
	 * @param string $icon
	 * @param string $attributes
	 *
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return $this->User->canEditFieldsOf('tl_countdowncalendar') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($calendar_name).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
	
	public function storeFileMetaInformation($varValue, DataContainer $dc)
	{
	    if ($dc->activeRecord->singleSRC != $varValue)
	    {
	        $this->addFileMetaInformationToRequest($varValue, 'tl_countdowncalendar', $dc->activeRecord->pid);
	    }
	    
	    return $varValue;
	}
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)   {
	    $this->import('BackendUser', 'User');
	    
	    if (strlen($this->Input->get('tid')))
	    {
	        $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
	        $this->redirect($this->getReferer());
	    }
	    
	    // Check permissions AFTER checking the tid, so hacking attempts are logged
	    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_countdowncalendar::published', 'alexf'))
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
	    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_mitarbeiter::published', 'alexf')) {
	        $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_example toggleVisibility', TL_ERROR);
	        $this->redirect('contao/main.php?act=error');
	    }
	    //Äh... was tut createInitialVersion?! und auch createNewVersion?! -> todo: deprecated!!! 
	    $this->createInitialVersion('tl_countdowncalendar', $intId);
	    
	    // Trigger the save_callback
	    if (is_array($GLOBALS['TL_DCA'][$strTable]['fields']['published']['save_callback'])) {
	        foreach ($GLOBALS['TL_DCA'][$strTable]['fields']['published']['save_callback'] as $callback){
	            $this->import($callback[0]);
	            $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
	        }
	    }
	    
	    // Update the database
	    $this->Database->prepare("UPDATE tl_countdowncalendar SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")->execute($intId);
	    $this->createNewVersion('tl_countdowncalendar', $intId);
	}
    
}
	
