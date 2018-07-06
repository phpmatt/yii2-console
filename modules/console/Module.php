<?php

namespace app\modules\console;

use Yii;
/**
 * console module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\console\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
      $this->layout = 'main';
      Yii::configure(Yii::$app,require __DIR__ .'/config.php');
    }
}
