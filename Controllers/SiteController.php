<?php

namespace App\Controllers;

use Reaction\Annotations\CtrlAuth;
use Reaction\Annotations\Ctrl;
use Reaction\Annotations\CtrlAction;
use Reaction\Helpers\Url;
use Reaction\Promise\Promise;
use Reaction\Routes\Controller;
use Reaction\Web\AppRequestInterface;
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
     * @param AppRequestInterface $request
     * @return Promise
     */
    public function actionIndex(AppRequestInterface $request)
    {
        return new Promise(function ($r, $c) use ($request) {
            try {
                $sessionKey = date('Y_m_d__H_i');
                $request->session->set($sessionKey, time());

                $data = [
                    'getQuery' => $request->queryString,
                    'getQueryParams' => $request->queryParams,
                    'getCookies' => $request->cookies,
                    //'getHeaders' => $request->headers,
                    'getContentType' => $request->contentType,
                    'getAbsoluteUrl' => $request->absoluteUrl,
                    'getUrl' => $request->url,
                    'getPathInfo' => $request->pathInfo,
                    'getScriptFile' => $request->scriptFile,
                    'getScriptUrl' => $request->scriptUrl,
                ];
                $body = print_r($data, true);
                $body .= "\n" . print_r($request->response->cookies, true);
                $body .= "\n" . print_r($request->session->data, true);

                $request->response->setBody($body);
                $response = $request->response->build();
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
     * @param AppRequestInterface $request
     * @return \Reaction\Web\ResponseBuilderInterface
     */
    public function actionTest(AppRequestInterface $request)
    {
        $request->response->setBody('Test');
        return $request->response;
    }

    /**
     * @CtrlAction(path="/test2/{name:\w+}[/{id:\d+}]", method={"GET","POST"})
     * @param AppRequestInterface $request
     * @return \Reaction\Web\ResponseBuilderInterface
     */
    public function actionTest2(AppRequestInterface $request, $name)
    {
        $args = func_get_args();
        array_shift($args);
        $args[] = Url::current([], false, $request);
        $request->response->setBody(print_r($args, true));
        return $request->response;
    }
}