<?php

declare(strict_types=1);

/**
 * SessionHijackingManager
 */

namespace App\SecurityManager;

/**
 * SessionHijackingManager
 */
class SessionHijackingManager
{
    /**
     * Check
     * @access public
     * 
     * @return bool
     */
    public function check(): bool
    {
        $user = unserialize($_SESSION['user']);

        if ($user->isAuthenticated()) {
            if (!isset($_COOKIE['kw_g']) || !isset($_SESSION['ticket']) || $_COOKIE['kw_g'] != $_SESSION['ticket']) {
                return false;
            }
        }

        return true;
    }

    /**
     * Generate
     * @access public
     * 
     * @return void
     */
    public function generate(): void
    {
        $cookie_name = "kw_g";
        $ticket = session_id().microtime().rand(0,9999999999);
        $ticket = hash('sha512', $ticket);

        setcookie($cookie_name, $ticket, time() + (60 * 15), '/', '', false, true);
        $_SESSION['ticket'] = $ticket;

        return;
    }
}