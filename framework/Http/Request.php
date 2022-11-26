<?php

declare(strict_types=1);

/*
 * Request class
 */

namespace Framework\Http;

use Framework\Exception\{BadHttpMethodException, BadHttpRequestException};

/**
 * Request
 */
class Request
{
	/**
	 * Get POST data
	 * @access public
	 * @param string $key
     * 
	 * @return mixed
	 */
	public function getPostData(string $key)
  	{
    	return isset($_POST[$key]) ? $_POST[$key] : null;
  	}

	/**
     * Get GET data
	 * @access public
	 * @param string $key
     * 
	 * @return mixed
	 */
	public function getGetData(string $key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	/**
     * Get session data
	 * @access public
	 * @param string $key
     * 
	 * @return mixed
	 */
	public function getSessionData(string $key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	/**
     * Get url
	 * @access public
     * 
	 * @return string
	 */
	public function getUrl(): string
	{
		return $_SERVER['REQUEST_URI'];
	}

	/**
     * Get ip
	 * @access public
     * 
	 * @return string
	 */
	public function getIp(): string
	{
		return $_SERVER['REMOTE_ADDR'];
	}

    /**
     * Set session data
     * @access public
     * @param string $key
     * @param mixed $value
     * 
     * @return void
     */
	public function setSessionData(string $key, $value): void
	{
		$_SESSION[$key] = $value;

		return;
	}

	/**
     * Is method
	 * @access public
     * @param string $method
     * 
	 * @return bool
	 */
	public function isMethod(string $method): bool
  	{
    	return ($_SERVER['REQUEST_METHOD'] == $method);
	}

	/**
     * Add flash message
     * @access public
     * @param string $type
     * @param string $message
     * 
     * @return void
     */
	public function addFlash(string $type, string $message): void
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
	 * isXmlHttpRequest
	 * @access public
	 * 
	 * @return bool
	 */
	public function isXmlHttpRequest(): bool
	{
		return ('XMLHttpRequest' == $_SERVER['HTTP_X_REQUESTED_WITH']);
	}

	/**
	 * IsAjaxRequest
	 * @access public
	 * @param string $method
	 * 
	 * @return bool
	 */
	public function isAjaxRequest(string $method): ?bool
	{
		if (!$this->isXmlHttpRequest()) {
            throw new BadHttpRequestException('La syntaxe de la requête est erronée');
        }

        if (!$this->isMethod($method)) {
            throw new BadHttpMethodException('Méthode de requête non autorisée');
		}
		
		return true;
	}
}