<?php
/**
 * @author      Serge Postrash aka SDKiller <admin@yiisoft.ru>
 * @link        http://yiisoft.ru
 * @copyright   Copyright (c) 2015 YiiSoft.ru
 * @license     http://yiisoft.ru/licenses/commercial
 */

namespace zyx\oy\fw\web;

use Yii;
use yii\base\InvalidCallException;
use yii\base\InvalidParamException;
use yii\web\Response;


/**
 * Class Controller
 * @package zyx\oy\fw\web
 *
 * Some convenient shortcut methods for web apps.
 */
class Controller extends \yii\web\Controller
{
    /**
     * @return void
     */
    public function responseRaw()
    {
        $this->setResponseFormat(Response::FORMAT_RAW);
    }

    /**
     * @return void
     */
    public function responseHtml()
    {
        $this->setResponseFormat(Response::FORMAT_JSON);
    }

    /**
     * @return void
     */
    public function responseJson()
    {
        $this->setResponseFormat(Response::FORMAT_JSON);
    }

    /**
     * @return void
     */
    public function responseJsonp()
    {
        $this->setResponseFormat(Response::FORMAT_JSONP);
    }

    /**
     * @return void
     */
    public function responseXml()
    {
        $this->setResponseFormat(Response::FORMAT_XML);
    }

    /**
     * @param string $format
     */
    public function setResponseFormat($format)
    {
        /* @var $response \yii\web\Response */
        $response = Yii::$app->response;

        if (!($response instanceof Response)) {
            throw new InvalidCallException('Response shoud be instance of yii\web\Response');
        }

        if (!array_key_exists($format, $response->formatters)) {
            throw new InvalidParamException('Formatter of type ' . $format . ' is not defined');
        }

        Yii::$app->response->format = $format;
    }
}
