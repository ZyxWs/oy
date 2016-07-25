<?php
/**
 * @author      Serge Postrash aka SDKiller <jexy.ru@gmail.com>
 * @link        https://github.com/ZyxWs/oy
 * @copyright   Copyright (c) 2014-2015 Serge Postrash
 * @license     BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\web;

use Yii;
use yii\base\Exception;
use yii\web\HttpException;


/**
 * This override prevents exposure of sensitive information in production environment.
 * @see https://github.com/yiisoft/yii2/issues/6723
 *
 * @package zyx\oy
 */
class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * @var bool If to force exposing sensitive information regardless of environment
     */
    public $forceExpose = false;


    /**
     * Runs the action
     *
     * @return string result content
     */
    public function run()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = $this->defaultName ?: Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if (YII_DEBUG || $this->forceExpose === true) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: $name;
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->controller->render($this->view ?: $this->id, [
                'name'      => $name,
                'message'   => $message,
                'exception' => $exception,
            ]);
        }
    }
}
