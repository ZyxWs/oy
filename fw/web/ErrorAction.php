<?php
/**
 * @link https://github.com/ZyxWs/oy
 * @copyright Copyright (c) 2014 Serge Postrash aka SDKiller
 * @license BSD 3-Clause, see LICENSE.md
 */

namespace zyx\oy\fw\web;

use Yii;
use yii\base\Exception;
use yii\web\HttpException;


/**
 * This override prevents exposure of sensitive information in production environment.
 * @see https://github.com/yiisoft/yii2/issues/6723
 *
 * @package zyx\oy\fw\web
 */
class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * @var bool if to force exposing sensitive information regardless of environment.
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
            return '';
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

        if (!YII_DEBUG || $this->forceExpose === true) {
            $message = $this->defaultMessage ?: $name;
        } else {
            $message = $exception->getMessage();
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
