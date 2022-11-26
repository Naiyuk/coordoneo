<?php

declare(strict_types=1);

/**
 * Captcha checker
 */

namespace App\ParamChecker;

use Framework\{
    Http\Request,
    Validator\CaptchaValidator
};

/**
 * CaptchaChecker
 */
class CaptchaChecker
{
    /**
     * @var CaptchaValidator
     * @access private
     */
    private $validator;
    
    /**
     * Constructor
     * @access public
     * @param CaptchaValidator $validator
     * 
     * @return void
     */
    public function __construct(CaptchaValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Check request
     * @access public
     * @param Request $request
     * 
     * @return boolean
     */
    public function check(Request $request): bool
    {
        $captcha = $request->getPostData('g-recaptcha-response');

        if (!$this->validator->isValid($captcha)) {
            $request->addFlash('error', 'Captcha invalide !');
            return false;
        }

        return true;
    }
}