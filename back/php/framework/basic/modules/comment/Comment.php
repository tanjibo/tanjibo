<?php

namespace app\modules\comment;

/**
 * comment module definition class
 */
class Comment extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\comment\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //在模块下配置子模块
        $this->module=[

          'category'=>[
            'class'=>'app\modules\comment\modules\category\Category'
          ]
        ];

        // custom initialization code goes here
    }
}
