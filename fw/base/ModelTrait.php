<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2015 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\base;

use Yii;
use yii\helpers\Inflector;


/**
 * Trait ModelTrait
 * @package zyx\oy\fw\base
 *
 * Stubs for autocomplete - these methods are implemented in Yii core classes:
 * @method \yii\base\Model::attributes()
 * @method \yii\base\Model::scenarios()
 * @method \yii\base\Model::getScenario()
 * @method \yii\base\Model::formName()
 */
trait ModelTrait
{
    /**
     * A workaround to set form name in model config if nesessary.
     * @see https://github.com/yiisoft/yii2/issues/6090
     * @var string the form name of this model class
     */
    protected $formName;


    /**
     * A setter for `$formName` (as we made it protected to avoid including in `attributes`)
     * @param string $name
     */
    public function setFormName($name)
    {
        $name = ($name === false) ? '' : $name;

        $this->formName = $name;
    }

    /**
     * @return string
     */
    public function generateFormName()
    {
        if ($this->formName === null || !is_string($this->formName)) {
            $reflector = new \ReflectionClass($this);
            $this->formName = $reflector->getShortName();;
        }

        return $this->formName;
    }

    /**
     * Returns list of attributes used in current scenario.
     * @return array|null
     */
    public function currentAttributes()
    {
        $scenarios = $this->scenarios();
        $scenario  = $this->getScenario();

        if (!isset($scenarios[$scenario])) {
            return [];
        }

        foreach ($scenarios[$scenario] as $i => $attribute) {
            if (strpos($attribute, '!', 0) === 0) {
                unset($scenarios[$scenario][$i]);
            }
        }

        return (array)$scenarios[$scenario];
    }

    /**
     * @param string $name
     * @param bool   $ucwords
     * @return string
     */
    public function generateAttributeLabel($name, $ucwords = false)
    {
        return ($ucwords === false) ? ucfirst(Inflector::camel2words($name, $ucwords)) : Inflector::camel2words($name, $ucwords);
    }

    /**
     * @param string $translationCategory
     * @return array
     */
    protected function translateAttributeLabels($translationCategory = null)
    {
        if (empty($translationCategory)) {
            //if 'app' translation category exists - retrieve it, else - get first (usually - 'yii' by default)
            $categories = array_keys(Yii::$app->getI18n()->translations);
            $translationCategory = in_array('app', $categories) ? 'app' : reset($categories);
        }

        $labels = [];

        foreach ($this->attributes() as $field_name) {
            $labels[$field_name] = Yii::t($translationCategory, $this->generateAttributeLabel($field_name));
        }

        return $labels;
    }

}
