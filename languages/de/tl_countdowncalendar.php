<?php

$strTable = 'tl_countdowncalendar';


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
$GLOBALS['TL_LANG'][$strTable]['new']= array('neuer Kalender','Einen neuen Kalender anlegen');
$GLOBALS['TL_LANG'][$strTable]['copy'] = array('Kopieren','Den Kalender ID %s kopieren');
$GLOBALS['TL_LANG'][$strTable]['show'] = array('Informationen','Die Details des Eintrages ID %s anzeigen');
$GLOBALS['TL_LANG'][$strTable]['edit'] = array('Bearbeiten','Die Kalender-Einträge von ID %s bearbeiten');
$GLOBALS['TL_LANG'][$strTable]['editheader'] = array('Anpassen','Die Kalender-Einstellungen bearbeiten');
$GLOBALS['TL_LANG'][$strTable]['delete'] = array('Löschen','Den Eintrag ID %s löschen');


$GLOBALS['TL_LANG'][$strTable]['title_legend']='Grundeinstellungen ';
$GLOBALS['TL_LANG'][$strTable]['debug_legend']='Debugging-Einstellungen ';
$GLOBALS['TL_LANG'][$strTable]['cc_layout_legend']= 'Layout-Einstellungen';


$GLOBALS['TL_LANG'][$strTable]['calendar_name'][0]='Kalendername';
$GLOBALS['TL_LANG'][$strTable]['calendar_name'][1]='Bitte geben Sie dem Kalender einen Namen.';

$GLOBALS['TL_LANG'][$strTable]['calendar_start'][0]='Startdatum';
$GLOBALS['TL_LANG'][$strTable]['calendar_start'][1]='Bitte geben Sie das Startdatum des Kalenders an.';

$GLOBALS['TL_LANG'][$strTable]['calendar_stop'][0]='Enddatum';
$GLOBALS['TL_LANG'][$strTable]['calendar_stop'][1]='Bitte geben Sie dem Kalender einen Namen.';

$GLOBALS['TL_LANG'][$strTable]['jumpTo']= array('Weiterleitungsseite',
                                                'Wählen Sie die Seite, auf die weitergeleitet werden soll, wenn ein Link geklickt wurde.');
$GLOBALS['TL_LANG'][$strTable]['urlFragment']= array('URL-Fragment',
                                                'Mit welchem Präfix sollen die Aliase beginnen? Bsp. "Tür" oder "Tag".');


$GLOBALS['TL_LANG'][$strTable]['acDebug']= array('Debug-Modus?',
                                                'Mit dem Debug-Modus können Sie ein anzunehmendes Datum wählen, mit dem die Frontendausgabe des Kalenders generiert wird. Das ist hilfreich, wenn der Kalender noch nicht online ist.');

$GLOBALS['TL_LANG'][$strTable]['acDebugDate']= array('Debug-Datum',
                                                'Der Kalender wird so im Frontend generiert, als sei heute das hier gewählte Datum.');


                                                

$GLOBALS['TL_LANG'][$strTable]['singleSRC']= array('Bilddatei',
                                                'Wählen Sie das Bild, das als responsiver pseudo-Hintergrund fungieren soll.');

$GLOBALS['TL_LANG'][$strTable]['size']= array('Bildgröße',
                                                'Wählen Sie die Bildgröße. Diese sollte responsiv sein, da sie die Container-Abmaße des Kalenders definiert.');

$GLOBALS['TL_LANG'][$strTable]['addOverlay']= array('Bild überlagern?',
                                                'Soll das Bild mit einer (transparenten) Farbe überlagert werden?');



$GLOBALS['TL_LANG'][$strTable]['overlayColor']= array('Farbe & Transparenz für die Überlagerung',
                                                'Wählen Sie Farbe & Transparenz, mit der das Bild überlagert werden soll.');
$GLOBALS['TL_LANG'][$strTable]['overlayType']= array('Überlagerungstyp',
                                                'Wählen Sie die Art der Überlagerung, die Optionen entsprechen dem CSS-Attribut mix-blend-mode.');
$GLOBALS['TL_LANG'][$strTable]['showGoneDates']= array('Vergangene Tage deaktivieren? (NICHT IMPLEMENTERT)',
                                                'Diese Funktion ist noch nicht aktivierbar.');
$GLOBALS['TL_LANG'][$strTable]['doorsPerRowLG']= array('Anzahl der Türen pro Reihe: Large devices',
                                                'Wie viele Türen sollen pro Reihe auf großen Displays angezeigt werden?');
$GLOBALS['TL_LANG'][$strTable]['doorsPerRowMD']= array('Anzahl der Türen pro Reihe: Medium devices',
                                                'Wie viele Türen sollen pro Reihe auf großen Displays angezeigt werden?');
$GLOBALS['TL_LANG'][$strTable]['doorsPerRowXS']= array('Anzahl der Türen pro Reihe: Small/XS devices',
                                                'Wie viele Türen sollen pro Reihe auf großen Displays angezeigt werden?');
$GLOBALS['TL_LANG'][$strTable]['breakpointMD']= array('Breakpoint für Medium Devices',
                                                'Welche Breite zieht die Grenze zwischen Large und Medium devices?');
$GLOBALS['TL_LANG'][$strTable]['breakpointXS']= array('Breakpoint für Small Devices',
                                                'Welche Breite zieht die Grenze zwischen Medium und Small devices?');

$GLOBALS['TL_LANG'][$strTable]['doorBgColor']= array('Türchen-Farbe',
                                                'Wählen Sie Farbe und Transparenz für die Kalendertüren.');

$GLOBALS['TL_LANG'][$strTable]['doorFontColor']= array('Türchen Schriftfarbe',
                                                'Wählen Sie die Schriftfarbe mit der die Zahlen angezeigt werden.');
$GLOBALS['TL_LANG'][$strTable]['doorSecretBgColor']= array('Hintergrundfarbe Türchenfüllung',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['doorSecretFontColor']= array('Schriftfarbe Türchenfüllung',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['popSecretButtonBgColor']= array('Popup Button-Hintergrundfarbe',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['popSecretButtonFontColor']= array('Popup Button-Schriftfarbe',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['popSecretBgColor']= array('Popup Hintergrundfarbe',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['popSecretFontColor']= array('Popup Schriftfarbe',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['svgSprites']= array('Türchen SVG-Sprites (NICHT IMPLEMENTIERT)',
                                                'Wählen Sie.');
$GLOBALS['TL_LANG'][$strTable]['jsTemplate']= array('Javascript Template (NICHT IMPLEMENTIERT)',
                                                'Wählen Sie.');
