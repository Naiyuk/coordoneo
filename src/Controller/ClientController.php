<?php

declare(strict_types=1);

/**
 * ClientController class
 */

namespace App\Controller;

use App\{
    Entity\Client,
    Form\ClientType,
    Manager\ClientManager,
    ParamChecker\CaptchaChecker
};
use Framework\{
    Form\Form,
    Http\Request,
    Http\Response,
    Routing\Router,
    Controller\Controller,
    Exception\NotFoundHttpException
};

/**
 * ClientController
 */
class ClientController extends Controller
{
    /**
     * Constructor
     * @access public
     * @param Response $response
     * @param Router $router
     * @param Form $form
     * @param ClientManager $manager
     * 
     * @return void
     */
    public function __construct(Response $response, Router $router, Form $form, ClientManager $manager)
    {
        $this->response = $response;
        $this->router = $router;
        $this->form = $form;
        $this->manager = $manager;
    }

    /**
     * Add client
     * @access public
     * @param Request $request
     * @param CaptchaChecker $captchaChecker
     * 
     * @return string
     */
    public function addAction(Request $request, CaptchaChecker $captchaChecker): ?string
    {
        $client = new Client();
        $clientFormType = new ClientType($this->manager);

        $form = $this->createForm($clientFormType, $client);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $captchaChecker->check($request) && $form->isValid()) {
            
            try {
                $this->manager->add($client);
                $this->addFlash('notice', 'Inscription enregistrée !');
            } catch(\PDOException $exception) {
                $this->addFlash('error', 'Une erreur est survenue');
            }

            $this->redirectToRoute('home');
        }

        return $this->render('client/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Edit client
     * @access public
     * @param Request $request
     * @param CaptchaChecker $captchaChecker
     * 
     * @return string
     */
    public function editAction(Request $request, CaptchaChecker $captchaChecker): ?string
    {
        if (!$this->getUser()->isAuthenticated()) {
            $this->redirectToRoute('login');
        }

        $client = $this->manager->getClient((int)$request->getGetData('id'));

        if (!$client) {
            throw new NotFoundHttpException('Page non trouvée');
        }

        $clientFormType = new ClientType($this->manager);

        $form = $this->createForm($clientFormType, $client);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $captchaChecker->check($request) && $form->isValid()) {
            
            try {
                $this->manager->edit($client);
                $this->addFlash('notice', 'Modifications enregistrées !');
            } catch(\PDOException $exception) {
                $this->addFlash('error', 'Une erreur est survenue');
            }

            $this->redirectToRoute('home');
        }

        return $this->render('client/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * List action
     * @access public
     * 
     * @return string
     */
    public function listAction(): ?string
    {
        if (!$this->getUser()->isAuthenticated()) {
            $this->redirectToRoute('login');
        }

        $clients = $this->manager->getClients(1);

        return $this->render('client/list.html.twig', ['clients' => $clients]);
    }
}