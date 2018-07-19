<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/19/2018
 * Time: 1:40 AM
 */

namespace AppBundle\Repository;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

interface JiraUserProviderInterface
{
    public function registerUser($username, $password): bool;

}