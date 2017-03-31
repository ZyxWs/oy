<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2017 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
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
        $this->setResponseFormat(Response::FORMAT_HTML);
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

    /**
     * Set a single view parameter from controller action.
     * @param string $name
     * @param mixed  $value
     */
    public function assignViewParam($name, $value)
    {
        $this->getView()->params[$name] = $value;
    }

    /**
     * Set multiple view parameters from controller action.
     * @param array $params
     */
    public function assignViewParams($params)
    {
        foreach ($params as $name => $value) {
            $this->assignViewParam($name, $value);
        }
    }

    /**
     * Get a single view parameter from controller action.
     * @param string $name
     * @param mixed  $default
     * @return mixed|null
     */
    public function fetchViewParam($name, $default = null)
    {
        $params = $this->getView()->params;

        return isset($params[$name]) ? $params[$name] : $default;
    }

    /**
     * Get all view parameters from controller action.
     * @return array
     */
    public function fetchViewParams()
    {
        $params = $this->getView()->params;

        return empty($params) ? [] : $params;
    }
}
