<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2017 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\caching;


/**
 * Class FileCache
 * @see https://github.com/yiisoft/yii2/issues/6809
 *
 * @package zyx\oy
 */
class FileCache extends \yii\caching\FileCache
{
    /**
     * @var int Application-wide value of cache duration (to keep BC defaults to 0 - that means never expire)
     */
    public $defaultDuration = 0;


    /**
     * @inheritdoc
     */
    public function set($key, $value, $duration = null, $dependency = null)
    {
        if ($duration === null) {
            $duration = $this->defaultDuration;
        }

        return parent::set($key, $value, $duration, $dependency);
    }
}
