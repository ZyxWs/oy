<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\db;

use Yii;
use zyx\oy\fw\base\ModelTrait;


/**
 * Class ActiveRecord
 * @package zyx\oy\fw\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use ModelTrait;

    /**
     * @inheritdoc
     *
     * A workaround for undesired attributes list in `TimestampBehavior`.
     * @see https://github.com/yiisoft/yii2/issues/4952
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'attributes' => [
                    static::EVENT_BEFORE_INSERT => 'created_at',
                    static::EVENT_BEFORE_UPDATE => 'updated_at',
                ]
            ],
        ];
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

    /**
     * Returns the list of all attribute names of the model.
     * This is a workaround to make possible retrieve attributes in static methods.
     *
     * @return array list of attribute names.
     */
    public static function attributesStatic()
    {
        return array_keys(static::getTableSchema()->columns);
    }

    /**
     * @param mixed $condition
     * @return int
     */
    public static function countAll($condition = null)
    {
        $q = empty($condition) ? static::find() : static::findByCondition($condition);

        return (int) $q->count();
    }

}
