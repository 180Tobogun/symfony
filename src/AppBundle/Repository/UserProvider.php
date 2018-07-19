<?php

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface {

    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }


    public function loadUserByUsername($username)
    {
        $user = $this->userManager->findUserByUsername($username);

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $user = new User();
        $user->setUsername($user->getUsername());

        $user->addRole('ROLE_ADMIN');
        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'AppBundle\Entity\User';
    }
}