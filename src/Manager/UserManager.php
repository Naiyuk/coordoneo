<?php

declare(strict_types=1);

/*
 * UserManager class
 */

namespace App\Manager;

use App\Entity\User;
use Framework\Manager\EntityManager;

/**
 * UserManager
 */
class UserManager extends EntityManager
{
	/**
     * Get user
	 * @access public
	 * @param string $email
     * 
	 * @return void
	 */
	public function getUser($email): ?User
	{
        $pdo = $this->database->getPdo();

        $request = $pdo->prepare('SELECT * FROM co_user WHERE u_email = :u_email');
        $request->bindValue(':u_email', $email, \PDO::PARAM_STR);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (empty($data)) {
            return null;
        }

        $user = new User;

        $user
            ->setId((int)$data['u_id'])
            ->setUsername($data['u_username'])
            ->setPassword($data['u_password'])
            ->setEmail($data['u_email'])
            ->setRole($data['u_role'])
        ;

        return $user;
	}
}