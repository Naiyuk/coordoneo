<?php

declare(strict_types=1);

/**
 * ClientType class
 */

namespace App\Form;

use Framework\{
    Form\Form,
    Form\FormType,
    Field\TextField,
    Field\StringField,
    Validator\RegexValidator,
    Validator\LengthValidator,
    Validator\UniqueValidator,
    Validator\NotNullValidator,
    Validator\CSRFTokenValidator,
    Validator\MaxLengthValidator,
    Validator\MinLengthValidator,
    Validator\SQLInjectionValidator
};
use App\Manager\ClientManager;

/**
 * ClientType
 */
class ClientType implements FormType
{
    /**
     * @var ClientManager
     * @access private
     */
    private $manager;

    /**
     * Constructor
     * @access public
     * @param ClientManager
     * 
     * @return void
     */
    public function __construct(ClientManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(Form $form): void
    {
        $form->add(new StringField([
            'name' => 'name',
            'label' => 'Nom',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer un nom !'),
                new MinLengthValidator('Le nom doit contenir 3 caractères minimums', 3),
                new MaxLengthValidator('Le nom doit contenir 40 caractères maximums', 40),
                new RegexValidator(
                    'Seuls les lettres, tirets et espaces sont autorisés',
                    '/^[a-zA-Z]+(([ -][a-zA-Z ])?[a-zA-Z]*)*$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !')
            ]
        ]));

        $form->add(new StringField([
            'name' => 'firstName',
            'label' => 'Prénom',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer un prénom !'),
                new MinLengthValidator('Le prénom doit contenir 3 caractères minimums', 3),
                new MaxLengthValidator('Le prénom doit contenir 40 caractères maximums', 40),
                new RegexValidator(
                    'Seuls les lettres, tirets et espaces sont autorisés',
                    '/^[a-zA-Z]+(([ -][a-zA-Z ])?[a-zA-Z]*)*$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !')
            ]
        ]));

        $form->add(new TextField([
            'name' => 'address',
            'label' => 'Adresse',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer une adresse !'),
                new MinLengthValidator('L\'adresse doit contenir 7 caractères minimums', 7),
                new MaxLengthValidator('L\'adresse doit contenir 80 caractères maximums', 80),
                new RegexValidator(
                    'Adresse invalide',
                    '/^[0-9]( [a-zA-Z]+)*$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !')
            ]
        ]));
                    
        $form->add(new StringField([
            'name' => 'postalCode',
            'label' => 'Code postal',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer un code postal !'),
                new LengthValidator('Le code postal doit contenir 5 caractères', 5),
                new RegexValidator(
                    'Code postal invalide',
                    '/^[0-9]{5}$/'
                )
            ]
        ]));

        $form->add(new StringField([
            'name' => 'city',
            'label' => 'Ville',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer une ville !'),
                new MinLengthValidator('La ville doit contenir 2 caractères minimums', 2),
                new MaxLengthValidator('Le ville doit contenir 50 caractères maximums', 50),
                new RegexValidator(
                    'Ville invalide',
                    '/^[a-zA-ZÀ-ÿa-ÿ]+(([ -][a-zA-ZÀ-ÿa-ÿ ])?[a-zA-ZÀ-ÿa-ÿ]*)*$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !')
            ]
        ]));

        $form->add(new StringField([
            'name' => 'country',
            'label' => 'Pays',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer un pays !'),
                new MinLengthValidator('Le pays doit contenir 4 caractères minimums', 4),
                new MaxLengthValidator('Le pays doit contenir 20 caractères maximums', 20),
                new RegexValidator(
                    'Seuls les lettres sont autorisés',
                    '/^[a-zA-Z]+$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !')
            ]
        ]));

        $form->add(new StringField([
            'name' => 'email',
            'label' => 'Email',
            'required' => true,
            'validators' => [
                new NotNullValidator('Vous devez entrer un email !'),
                new MinLengthValidator('L\'email doit contenir 7 caractères minimums', 7),
                new MaxLengthValidator('L\'email doit contenir 70 caractères maximums', 70),
                new RegexValidator(
                    'Adresse email invalide',
                    '/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/'
                ),
                new SQLInjectionValidator('Certains mots ne sont pas autorisés !'),
                new UniqueValidator("Cet email est déjà utilisé", $this->manager)
            ]
        ]));

        $form->add(new StringField([
            'name' => 'token',
            'type' => 'hidden',
            'required' => true,
            'value' => $_SESSION['token'],
            'validators' => [
                new CSRFTokenValidator('Jeton CSRF invalide !')
            ]
        ]));
    }
}