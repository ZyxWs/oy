<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2017 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\helpers;

use Yii;
use yii\helpers\BaseInflector;

/**
 * Class Inflector
 * @package zyx\oy\fw\helpers
 *
 * Is intended to override \yii\helpers\Inflector to disable Intl forcefully and implement custom
 * transliteration of cyrillic characters.
 * To make use of it you need to create somewhere in your application a new class, extending from this class,
 * named [[yii\helpers\Inflector]] - note the namespace(!) - and point on it to Yii autoloader, for example
 * in common/config/bootstrap.php:
 *  ```
 *  Yii::$classMap['yii\helpers\Inflector'] = '@common/helpers/Inflector.php';
 *  ```
 * @link http://www.yiiframework.com/doc-2.0/guide-helper-overview.html#customizing-helper-classes
 */
class Inflector extends BaseInflector
{
    /**
     * @var array map for transliteration used by [[slug()]]
     */
    public static $transliteration = [
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Є' => 'E', 'Э' => 'E',
        'Ё' => 'JO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Ї' => 'JI', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M',
        'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'KH',
        'Ц' => 'TS', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHCH', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Ю' => 'YU',
        'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'є' => 'e', 'э' => 'e',
        'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'ї' => 'ji', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'kh',
        'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'ю' => 'yu',
        'я' => 'ya',
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
    ];

    /**
     * Disable Intl forcefully for transliteration purposes.
     * @return boolean if intl extension is loaded
     */
    protected static function hasIntl()
    {
        return false;
    }
}
