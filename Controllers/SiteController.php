<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Reaction\Annotations\Ctrl;
use Reaction\Annotations\CtrlAction;
use Reaction\Web\Response;

/**
 * @Ctrl
 * Class SiteController
 * @package App\Controllers
 */
class SiteController
{
    /**
     * @CtrlAction(path="/")
     * Index action
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function actionIndex(ServerRequestInterface $request) {
        return new Response(200, [], 'Home page');
    }
}