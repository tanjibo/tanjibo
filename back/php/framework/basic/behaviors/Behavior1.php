
<?php

namespace app\behaviors;

use yii\base\Behavior;

class Behavior1 extends Behavior
{
    public $height;
    public function eat()
    {
        echo 'dog';
    }


    function events(){
      return [

        'wang'=>"shout"
      ];
    }

    function shout(){

      echo '这是别人出发我类';
    }
}
