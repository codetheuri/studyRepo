<?php

namespace app\modules\studyRepo;

/**
 * studyRepo module definition class
 */
class studyRepo extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\studyRepo\controllers';
    public $layout = 'Alayout';
    public $defaultRoute = 'paper/index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
