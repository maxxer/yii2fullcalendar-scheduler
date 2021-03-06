<?php

namespace yii2fullcalendarscheduler;

use Yii;
use yii\web\AssetBundle;

/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class CoreAsset extends AssetBundle
{
    /**
     * [$sourcePath description]
     * @var string
     */
    public $sourcePath = '@bower';

    /**
     * the language the calender will be displayed in
     * @var string ISO2 code for the wished display language
     */
    public $language = NULL;

    /**
     * [$autoGenerate description]
     * @var boolean
     */
    public $autoGenerate = true;

    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar = false;
    
    /**
     * [$css description]
     * @var array
     */
    public $css = [
        'fullcalendar/dist/fullcalendar.css',
        'fullcalendar-scheduler/dist/scheduler.css',
    ];

    /**
     * [$js description]
     * @var array
     */
    public $js = [
        'fullcalendar/dist/fullcalendar.js',        
        'fullcalendar/dist/locale-all.js',
        'fullcalendar-scheduler/dist/scheduler.js',
    ];
    
    /**
     * [$depends description]
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii2fullcalendarscheduler\MomentAsset',
        'yii2fullcalendarscheduler\PrintAsset'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $language = $this->language ? $this->language : Yii::$app->language;
        if ($language != 'en-us') 
        {
            if (file_exists(Yii::getAlias($this->sourcePath."/"."fullcalendar/dist/locale/{$language}.js"))) {
                $this->js[] = "fullcalendar/dist/locale/{$language}.js";
            } else {
                // try shorter version of locale
                $this->js[] = "fullcalendar/dist/locale/".substr($language, 0, 2).".js";
            }
        }

        if($this->googleCalendar)
        {
            $this->js[] = 'fullcalendar/dist/gcal.js';
        }

        parent::registerAssetFiles($view);
    }

}
