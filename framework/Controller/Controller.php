<?php

declare(strict_types=1);

/**
 * Controller class
 */

namespace Framework\Controller;

use App\Entity\User;
use Framework\{
    Form\Form,
    Entity\Entity,
    Form\FormType,
    Http\Response,
    Routing\Router,
    Manager\EntityManager
};

/**
 * Controller
 * @abstract
 */
abstract class Controller
{
    /**
     * @var Response
     * @access protected
     */
    protected $response;

    /**
     * @var Router
     * @access protected
     */
    protected $router;

    /**
     * @var Form
     * @access protected
     */
    protected $form;

    /**
     * @var EntityManager
     * @access protected
     */
    protected $manager;

    /**
     * Render view
     * @access protected
     * @param string $template
     * @param array $data
     * @param int $code
     * 
     * @return string
     */
    protected function render(string $template, array $data = [], int $code = 200): string
    {
        $user = $this->getUser();
        $data['user'] = $user;

        $flashes = [];

        if (isset($_SESSION['flashes'])) {
            $flashes = $_SESSION['flashes'];
            unset($_SESSION['flashes']);
        }

        $data['flashes'] = $flashes;

        return $this->response->renderView($template, $data, $code);
    }

    /**
     * Add flash message
     * @access protected
     * @param string $type
     * @param string $message
     * 
     * @return void
     */
    protected function addFlash(string $type, string $message): void
    {
        if (isset($_SESSION['flashes'])) {
            $flashes = $_SESSION['flashes'];

            $flashes[$type][] = $message;
            $_SESSION['flashes'] = $flashes;

            return;
        }

        $flashes = [];
        $flashes[$type][] = $message;
        $_SESSION['flashes'] = $flashes;

        return;
    }

    /**
     * Get user entity
     * @access protected
     * 
     * @return User
     */
    protected function getUser(): User
    {
        $user = unserialize($_SESSION['user']);

        return $user;
    }

    /**
     * Redirect to route
     * @access protected
     * @param string $routeName
     * @param array $param
     * 
     * @return void
     */
    protected function redirectToRoute(string $routeName, array $param = []): void
    {
        $url = $this->router->getUrlByRouteName($routeName, $param);

        $this->response->redirect($url);
    }

    /**
     * Create form
     * @access protected
     * @param FormType $formType
     * @param Entity $entity
     * 
     * @return Form
     */
    protected function createForm(FormType $formType, Entity $entity): Form
    {
        $this->form->setEntity($entity);
        $formType->buildForm($this->form);

        return $this->form;
    }
}