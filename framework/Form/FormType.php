<?php

declare(strict_types=1);

/**
 * FormType interface
 */

namespace Framework\Form;

use Framework\Form\Form;

/**
 * FormType
 */
interface FormType
{
    /**
     * Build Form
     * @access public
     * @param Form $form
     * 
     * @return void
     */
    public function buildForm(Form $form);
}