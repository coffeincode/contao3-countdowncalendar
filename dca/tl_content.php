<?php
if (Input::get('do') == 'countdowncalendar')
{
    $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_countdown_door';
}
