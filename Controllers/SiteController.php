<?php

namespace App\Controllers;

use Reaction\Annotations\CtrlAuth;
use Reaction\Annotations\Ctrl;
use Reaction\Annotations\CtrlAction;
use Reaction\Helpers\Url;
use Reaction\Promise\Promise;
use Reaction\RequestApplicationInterface;
use Reaction\Routes\Controller;
use Reaction\Web\Response;

/**
 * @Ctrl
 * @CtrlAuth
 * Class SiteController
 * @package App\Controllers
 */
class SiteController extends Controller
{
    /**
     * @CtrlAction(path="/test")
     * @CtrlAuth
     * Index action
     * @param RequestApplicationInterface $app
     * @return Promise
     */
    public function actionIndex(RequestApplicationInterface $app)
    {
        return new Promise(function ($r, $c) use ($app) {
            try {
                $request = $app->reqHelper;
                $sessionKey = date('Y_m_d__H_i');
                $app->session->set($sessionKey, time());

                $data = [
                    'getQuery' => $app->reqHelper->getQueryString(),
                    'getQueryParams' => $request->getQueryParams(),
                    'getCookies' => $request->getCookies(),
                    //'getHeaders' => $request->getHeaders(),
                    'getContentType' => $request->getContentType(),
                    'getAbsoluteUrl' => $request->getAbsoluteUrl(),
                    'getUrl' => $request->getUrl(),
                    'getPathInfo' => $request->getPathInfo(),
                    'getScriptFile' => $request->getScriptFile(),
                    'getScriptUrl' => $request->getScriptUrl(),
                ];
                $body = print_r($data, true);
                $body .= "\n" . print_r($app->response->cookies, true);
                $body .= "\n" . print_r($app->session->data, true);

                $app->response->setBody($body);
                $response = $app->response->build();
                $r($response);
                return;
            } catch (\Throwable $e) {
                $message = get_class($e) . "\n" . $e->getMessage() . "\n" . $e->getTraceAsString();
            }
            $response = (new Response(200, [], $message))->withAddedHeader('test', 'test');
            $r($response);
        });
    }

    /**
     * @CtrlAction(path="/test1/test2/{name:\w+}")
     * @param RequestApplicationInterface $app
     * @return \Reaction\Web\ResponseBuilderInterface
     */
    public function actionTest(RequestApplicationInterface $app)
    {
        $app->response->setBody('Test');
        return $app->response;
    }

    /**
     * @CtrlAction(path="/test2/{name:\w+}[/{id:\d+}]", method={"GET","POST"})
     * @param RequestApplicationInterface $app
     * @param string                      $name
     * @return \Reaction\Web\ResponseBuilderInterface
     */
    public function actionTest2(RequestApplicationInterface $app, $name)
    {
        $args = func_get_args();
        array_shift($args);
        $args[] = Url::current([], false, $app);
        $app->response->setBody(print_r($args, true));
        return $app->response;
    }
}