<?php

declare(strict_types=1);

/*
 * Captcha validator
 */

namespace Framework\Validator;

use ReCaptcha\ReCaptcha;
use Framework\{
    Http\Request,
    Validator\Validator
};

/**
 * CaptchaValidator
 */
class CaptchaValidator extends Validator
{
    /**
     * 
     * @var Recaptcha
     * @access private
     */
    private $captcha;

    /**
     * 
     * @var Request
     * @access private
     */
    private $request;
    
    /**
	 * Constructor
     * @access public
     * @param string $captchaKey
     * @param Request $request
     * 
     * @return void
	 */
    public function __construct(string $captchaKey, Request $request)
    {
        $this->captcha = new ReCaptcha($captchaKey);
        $this->request = $request;
    }

    /**
	 * {@inheritDoc}
	 */
    public function isValid($value): bool
    {
        $resp = $this->captcha->verify($value, $this->request->getIp());

        if (!$resp->isSuccess()) {
            return false;
        }

        return true;
    }
}