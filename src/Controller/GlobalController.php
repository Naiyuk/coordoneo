<?php

declare(strict_types=1);

/**
 * GlobalController class
 */

namespace App\Controller;

use Framework\{
    Http\Response,
    Controller\Controller
};

/**
 * GlobalController
 */
class GlobalController extends Controller
{
    /**
     * Constructor
     * @access public
     * @param Response $response
     * 
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Home action
     * @access public
     * 
     * @return mixed string
     */
    public function homeAction(): string
    {
        return $this->render('global/home.html.twig');
    }
}