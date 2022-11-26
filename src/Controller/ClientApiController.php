<?php

declare(strict_types=1);

/**
 * ClientApiController class
 */

namespace App\Controller;

use Framework\{
    Http\Request,
    Http\Response,
    Controller\Controller,
    Exception\AccessDeniedException,
    Exception\NotFoundHttpException
};
use App\Manager\ClientManager;

/**
 * ClientApiController
 */
class ClientApiController extends Controller
{
    /**
     * Constructor
     * @access public
     * @param Response $response
     * @param ClientManager $manager
     * 
     * @return void
     */
    public function __construct(Response $response, ClientManager $manager)
    {
        $this->response = $response;
        $this->manager = $manager;
    }

    /**
     * Delete client
     * @access public
     * @param Request $request
     * 
     * @return string
     */
    public function deleteAction(Request $request): ?string
    {
        if (!$this->getUser()->isAuthenticated()) {
            throw new AccessDeniedException(
                'Une authentification est nécessaire pour accéder à la ressource'
            );
        }

        if ($request->isAjaxRequest('DELETE')) {
            $client = $this->manager->getClient((int)$request->getGetData('id'));

            if (!$client) {
                throw new NotFoundHttpException('Ressource introuvable');
            }

            $this->manager->delete($client);

            return $this->response->json(null, 204);
        }
    }

    /**
     * List action
     * @access public
     * @param Request $request
     * 
     * @return string
     */
    public function listAction(Request $request): ?string
    {
        if (!$this->getUser()->isAuthenticated()) {
            throw new AccessDeniedException(
                'Une authentification est nécessaire pour accéder aux ressources'
            );
        }

        if ($request->isAjaxRequest('GET')) {
            $clients = $this->manager->getClients((int)$request->getGetData('page'));

            $datas = [];

            foreach ($clients as $client) {       
                $data = [
                    'id' => $client->getId(),
                    'name' => $client->getName(),
                    'firstName' => $client->getFirstName(),
                    'address' => $client->getAddress(),
                    'postalCode' => $client->getPostalCode(),
                    'city' => $client->getCity(),
                    'country' => $client->getCountry(),
                    'email' => $client->getEmail(),
                ];

                $datas[] = $data;
            }

            return $this->response->json($datas);
        }
    }
}