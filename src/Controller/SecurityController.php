<?php

declare(strict_types=1);

/**
 * SecurityController class
 */

namespace App\Controller;

use Framework\{
    Http\Request,
    Http\Response,
    Routing\Router,
    Controller\Controller,
    Exception\AuthenticationException
};
use App\{
    ParamChecker\CaptchaChecker,
    Authenticator\UserAuthenticator
};

/**
 * SecurityController
 */
class SecurityController extends Controller
{
    /**
     * Constructor
     * @access public
     * @param Response $response
     * @param Router $router
     * 
     * @return void
     */
    public function __construct(Response $response, Router $router)
    {
        $this->response = $response;
        $this->router = $router;
    }

    /**
     * Add client
     * @access public
     * @param Request $request
     * @param CaptchaChecker $captchaChecker
     * @param UserAuthenticator $authenticator
     * 
     * @return string
     */
    public function loginAction(Request $request, CaptchaChecker $captchaChecker, UserAuthenticator $authenticator): ?string
    {
        $user = $this->getUser();

        if ($user->isAuthenticated()) {
            $this->redirectToRoute('home');
        }

        $token = $request->getSessionData('token');

        $error = '';

        if ($request->isMethod('POST') && $captchaChecker->check($request)) {
            try {
                $user = $authenticator->authentication($request);
                $request->setSessionData('user', serialize($user));
                $this->addFlash('notice', 'Bonjour ' . $user->getUsername());
                $this->redirectToRoute('home');
            } catch(AuthenticationException $exception) {
                $error = $exception->getMessage();
            }
        }

        return $this->render('security/login.html.twig', ['error' => $error, 'token' => $token]);
    }

    /**
     * Logout action
     * @access public
     * 
     * @return void
     */
    public function logoutAction(): void
    {
        $this->response->endSession();
        $this->redirectToRoute('home');
    }
}