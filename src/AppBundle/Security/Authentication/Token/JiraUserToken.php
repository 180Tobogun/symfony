<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/18/2018
 * Time: 10:37 PM
 */

namespace AppBundle\Security\Authentication\Token;


use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class JiraUserToken extends AbstractToken
{

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }

}