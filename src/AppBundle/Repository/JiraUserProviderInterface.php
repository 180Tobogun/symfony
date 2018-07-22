<?php

namespace AppBundle\Repository;

interface JiraUserProviderInterface
{
    public function loadUser($username, $password): ?JiraUser;

}