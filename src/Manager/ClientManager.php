<?php

declare(strict_types=1);

/*
 * ClientManager class
 */

namespace App\Manager;

use App\Entity\Client;
use Framework\{
    Paginator\Paginator,
    Manager\EntityManager
};

/**
 * ClientManager
 */
class ClientManager extends EntityManager
{
	/**
	 * @access public
	 * @param Client $client
     * 
	 * @return void
	 */
	public function add(Client $client): void
	{
        $pdo = $this->database->getPdo();

		$request = $pdo->prepare(
            'INSERT INTO co_client (c_name, c_first_name, c_address, c_postal_code, c_city, c_country, c_email)
            VALUES (:c_name, :c_first_name, :c_address, :c_postal_code, :c_city, :c_country, :c_email)'
        );
        
        $request->bindValue(':c_name', $client->getName(), \PDO::PARAM_STR);
        $request->bindValue(':c_first_name', $client->getFirstName(), \PDO::PARAM_STR);
        $request->bindValue(':c_address', $client->getAddress(), \PDO::PARAM_STR);
        $request->bindValue(':c_postal_code', $client->getPostalCode(), \PDO::PARAM_STR);
        $request->bindValue(':c_city', $client->getCity(), \PDO::PARAM_STR);
        $request->bindValue(':c_country', $client->getCountry(), \PDO::PARAM_STR);
        $request->bindValue(':c_email', $client->getEmail(), \PDO::PARAM_STR);

        $request->execute();
        $request->closeCursor();

        return;
    }
    
    /**
     * Edit client
	 * @access public
	 * @param Client $client
     * 
	 * @return void
	 */
	public function edit(Client $client): void
	{
        $pdo = $this->database->getPdo();

		$request = $pdo->prepare(
			'UPDATE co_client SET
                c_name = :c_name,
                c_first_name = :c_first_name,
                c_address = :c_address,
                c_postal_code = :c_postal_code,
                c_city = :c_city,
                c_country = :c_country,
                c_email = :c_email
                WHERE c_id = :c_id'
		);
		$request->bindValue(':c_name', $client->getName(), \PDO::PARAM_STR);
        $request->bindValue(':c_first_name', $client->getFirstName(), \PDO::PARAM_STR);
        $request->bindValue(':c_address', $client->getAddress(), \PDO::PARAM_STR);
        $request->bindValue(':c_postal_code', $client->getPostalCode(), \PDO::PARAM_STR);
        $request->bindValue(':c_city', $client->getCity(), \PDO::PARAM_STR);
        $request->bindValue(':c_country', $client->getCountry(), \PDO::PARAM_STR);
        $request->bindValue(':c_email', $client->getEmail(), \PDO::PARAM_STR);
		$request->bindValue(':c_id', (int) $client->getId(), \PDO::PARAM_INT);
		$request->execute();

		$request->closeCursor();
	}

	/**
     * Is exists
	 * @access public
	 * @param string $email
     * 
	 * @return bool
	 */
	public function isExists(string $email): bool
	{
        $pdo = $this->database->getPdo();

		$request = $pdo->prepare('SELECT COUNT(*) FROM co_client WHERE c_email = :c_email');
        $request->bindValue(':c_email', $email, \PDO::PARAM_STR);
        $request->execute();

        $exists = $request->fetchColumn();
        $request->closeCursor();

		return (bool) $exists;
    }
    
    /**
     * Get client
	 * @access public
	 * @param int $id
     * 
	 * @return void
	 */
	public function getClient(int $id): ?Client
	{
        $pdo = $this->database->getPdo();

        $request = $pdo->prepare('SELECT * FROM co_client WHERE c_id = :c_id');
        $request->bindValue(':c_id', $id, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (empty($data)) {
            return null;
        }

        $client = new Client();

        $client
            ->setId((int)$data['c_id'])
            ->setName($data['c_name'])
            ->setFirstName($data['c_first_name'])
            ->setAddress($data['c_address'])
            ->setPostalCode($data['c_postal_code'])
            ->setCity($data['c_city'])
            ->setCountry($data['c_country'])
            ->setEmail($data['c_email'])
        ;

        $request->closeCursor();

        return $client;
    }
    
    /**
     * Get clients
	 * @access public
     * @param int $page
     * 
	 * @return array
	 */
	public function getClients(int $page): array
	{
        $pdo = $this->database->getPdo();

        $query = 'SELECT * FROM co_client ORDER BY c_name, c_first_name';

        $paginator = new Paginator();
        $query = $paginator->paginate($query, $page, CLIENT::CLIENT_PER_PAGE);

        $request = $pdo->query($query);
        
        $clients = [];

        while ($data = $request->fetch(\PDO::FETCH_ASSOC)) {

            $client = new Client();

            $client
                ->setId((int)$data['c_id'])
                ->setName($data['c_name'])
                ->setFirstName($data['c_first_name'])
                ->setAddress($data['c_address'])
                ->setPostalCode($data['c_postal_code'])
                ->setCity($data['c_city'])
                ->setCountry($data['c_country'])
                ->setEmail($data['c_email'])
            ;

            $clients[] = $client;
        }

        $request->closeCursor();

        return $clients;
    }
    
    /**
     * Delete
     * @access public
     * @param Client $client
     * 
     * @return void
     */
    public function delete(Client $client): void
    {
        $pdo = $this->database->getPdo();

        $id = $client->getId();

        $pdo->exec('DELETE FROM co_client WHERE c_id = ' . (int) $id);

        return;
    }
}