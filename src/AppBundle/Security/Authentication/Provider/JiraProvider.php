<?php

namespace AppBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AppBundle\Security\Authentication\Token\JiraUserToken;

/**
 * We do not authenticate by jira. Only create token
 */
class JiraProvider implements AuthenticationProviderInterface
{
    

    public function authenticate(TokenInterface $token)
    {
    }

    public function supports(TokenInterface $token)
    {
        return false;
    }

}