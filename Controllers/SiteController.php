<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Reaction\Annotations\Ctrl;
use Reaction\Annotations\CtrlAction;
use Reaction\Promise\Promise;
use Reaction\Web\Cookie;
use Reaction\Web\AppRequestInterface;
use Reaction\Web\Response;

/**
 * @Ctrl
 * Class SiteController
 * @package App\Controllers
 */
class SiteController
{
    /**
     * @CtrlAction(path="/test")
     * Index action
     * @param AppRequestInterface $request
     * @return Promise
     */
    public function actionIndex(AppRequestInterface $request)
    {
        return new Promise(function ($r, $c) use ($request) {
            $message = 'Home page';
            try {
                $sessionKey = date('Y_m_d__H_i');
                $request->session->set($sessionKey, time());

                $data = [
                    'getQuery' => $request->queryString,
                    'getQueryParams' => $request->queryParams,
                    'getCookies' => $request->cookies,
                    'getHeaders' => $request->headers,
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
}