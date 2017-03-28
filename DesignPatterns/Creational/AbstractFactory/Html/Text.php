<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/11/11
 * Time: 下午6:00
 */

namespace  DesignPatterns\Creational\AbstractFactroy\Html;

use DesignPatterns\Creational\AbstractFactroy\Text as BaseText;

class Text extends  BaseText{
    
    public  function render ()
    {
        return '<div>'.htmlspecialchars($this->text).'</div>';
    }
}