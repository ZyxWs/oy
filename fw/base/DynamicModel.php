<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2017 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\base;

use Yii;

/**
 * Class DynamicModel
 * @package zyx\oy\fw\base
 */
class DynamicModel extends \yii\base\DynamicModel
{
    use ModelTrait;

    /**
     * Returns the list of attribute names (model public properties along with `$_attributes` array members).
     *
     * Important:
     * if there are duplicate names of public properties and keys of `$_attributes` - then public properties
     * will have precedence in set/get actions. It is better to avoid such ambiguity when naming properties.
     *
     * A workaround to override 'privateness' of `$_attributes` in `DynamicModel` when extending from it
     * @see https://github.com/yiisoft/yii2/issues/4836
     */
    public function attributes()
    {
        return array_unique(array_merge(parent::attributes(), array_keys(Yii::getObjectVars($this))));
    }

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
