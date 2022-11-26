<?php

declare(strict_types=1);

/**
 * Exception controller
 */

namespace App\Controller;

use Framework\{
    Http\Response,
    Controller\Controller,
    Exception\FrameworkException
};

/**
 * ExceptionController
 */
class ExceptionController extends Controller
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
     * Error action
     * @access public
     * @param \Exception $exception
     * 
     * @return string
     */
    public function errorAction(\Exception $exception): ?string
    {
        $code = 500;
        $message = 'Erreur serveur';

        if ($exception instanceof FrameworkException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return $this->render('error/error.html.twig', ['code' => $code, 'message' => $message], $code);
    }
}