<?php

declare(strict_types=1);

/**
 * UserAuthenticator class
 */

namespace App\Authenticator;

use App\{
    Entity\User,
    Manager\UserManager,
    SecurityManager\SessionHijackingManager
};
use Framework\{
    Http\Request,
    Validator\CSRFTokenValidator,
    Validator\SQLInjectionValidator,
    Exception\AuthenticationException
};

/**
 * UserAuthenticator
 */
class UserAuthenticator
{
    /**
     * @var UserManager
     * @access private
     */
    private $manager;

    /**
     * @var SessionHijackingManager
     * @access private
     */
    private $hijackingManager;

    /**
     * Constructor
     * @access public
     * @param UserManager $manager
     * @param SessionHijackingManager $hijackingManager
     * 
     * @return void
     */
    public function __construct(UserManager $manager, SessionHijackingManager $hijackingManager)
    {
        $this->manager = $manager;
        $this->hijackingManager = $hijackingManager;
    }

    /**
     * Get credentials
     * @access private
     * @param Request $request
     * 
     * @return array
     */
    private function getCredentials(Request $request): ?array
    {
        $csrfToken = $request->getPostData('token');
        $csrfValidator = new CSRFTokenValidator('Jeton CSRF invalide !');

        if (!$csrfValidator->isValid($csrfToken)) {
            throw new AuthenticationException($csrfValidator->getError());
        }

        $email = $request->getPostData('email');
        $sqlValidator = new SQLInjectionValidator('Certains mots ne sont pas autorisés !');

        if (!$sqlValidator->isValid($email)) {
            throw new AuthenticationException($sqlValidator->getError());
        }

        $password = $request->getPostData('password');

        return [
            'email' => $email,
            'password' => $password
        ];
    }

    /**
     * Get user
     * @access private
     * @param string $email
     * 
     * @return User
     */
    private function getUser($email): ?User
    {
        if (empty($email)) {
            throw new AuthenticationException('Vous devez entrer une email');
        }

        $user = $this->manager->getUser($email);

        return $user;
    }

    /**
     * Check password
     * @access private
     * @param User $user
     * @param string $password
     * 
     * @return bool
     */
    private function checkPassword(User $user, $password): ?bool
    {
        if (password_verify($password, $user->getPassword())) {
            return true;
        }

        throw new AuthenticationException('L\'email ou le mot de passe est incorrect');
    }

    /**
     * Authentication
     * @access public
     * @param Request $request
     * 
     * @return User $user
     */
    public function authentication(Request $request): ?User
    {
        $credentials = $this->getCredentials($request);

        $user = $this->getUser($credentials['email']);

        if (!$user) {
            throw new AuthenticationException('L\'email ou le mot de passe est incorrect');
        }

        if ($this->checkPassword($user, $credentials['password'])) {
            $user->setAuthenticated(true);
            $this->hijackingManager->generate();
            return $user;
        }
    }
}