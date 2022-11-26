<?php

declare(strict_types=1);

/**
 * Response class
 */

namespace Framework\Http;

/**
 * Response
 */
class Response
{
    /**
     * @var string
     */
    public const VIEWS_DIR = __DIR__.'/../../app/views';

    /**
	 * @var Twig_Environment
	 * @access private
	 */
    private $twig;

    /**
     * Constructor
	 * @access public
     * 
     * @return void
	 */
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(self::VIEWS_DIR);
	   	$this->twig = new \Twig\Environment($loader); 
    }

    /**
     * Redirect
	 * @access public
	 * @param string $location
     * 
	 * @return void
	 */
	public function redirect(string $location): void
	{
        header("Location: ".$location);
        exit;
    }
    
    /**
	 * Render view
	 * @access public
	 * @param string $template
	 * @param array $data
     * @param int $code
     * 
	 * @return string
	 */
    public function renderView(string $template, array $data = [], int $code = 200): string
    {
        http_response_code($code);

        return $this->twig->render($template, $data);
    }
    
    /**
     * Json
     * @access public
     * @param mixed $data
     * @param int $code
     * 
     * @return string
     */
    public function json($data, int $code = 200): ?string
    {
        $json = json_encode($data);
        http_response_code($code);

        return $json;
    }

	/**
     * End session
	 * @access public
     * 
	 * @return void
	 */
	public function endSession(): void
	{
		$_SESSION = array();
       	session_destroy();
	}
}