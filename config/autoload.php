<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 
ClassLoader::addNamespaces(array
(
	'Coffeincode',
));
*/

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Models
	'CountdownCalendarModel' => 'system/modules/countdowncalendar/models/CountdownCalendarModel.php',
	'CountdownDoorModel'     => 'system/modules/countdowncalendar/models/CountdownDoorModel.php',

	// Modules
	'ModuleCountdownDoorReader'                            => 'system/modules/countdowncalendar/modules/ModuleCountdownDoorReader.php',
	'ModuleCountdownCalendar'                              => 'system/modules/countdowncalendar/modules/ModuleCountdownCalendar.php',
	'ModuleCountdownDoor'                                  => 'system/modules/countdowncalendar/modules/ModuleCountdownDoor.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_ac_door_reader' => 'system/modules/countdowncalendar/templates',
	'ac_default'         => 'system/modules/countdowncalendar/templates',
	'ac_full'            => 'system/modules/countdowncalendar/templates',
	'default_secret'     => 'system/modules/countdowncalendar/templates',
	'mod_ac_calendar'    => 'system/modules/countdowncalendar/templates',
));
