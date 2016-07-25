<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2015 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\base;


/**
 * Class Model
 * @package zyx\oy\fw\base
 */
class Model extends \yii\base\Model
{
    use ModelTrait;

    /**
     * @inheritdoc
     *
     * A workaround to get attribute labels already translated.
     */
    public function attributeLabels()
    {
        return $this->translateAttributeLabels();
    }

    /**
     * @inheritdoc
     *
     * A workaround to set form name in model config if nesessary.
     * @see https://github.com/yiisoft/yii2/issues/6090
     */
    public function formName()
    {
        return $this->generateFormName();
    }

}
