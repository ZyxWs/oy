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
 * Initially was implemented to resolve upstream issue #6809 with default cache duration.
 * As this feature was implemented in Yii since 2.0.11, this class is left to keep BC.
 * @see     https://github.com/yiisoft/yii2/issues/6809
 *
 * @package zyx\oy
 */
class FileCache extends \yii\caching\FileCache
{
}
