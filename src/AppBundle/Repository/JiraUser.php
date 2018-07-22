<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/22/2018
 * Time: 6:30 PM
 */

namespace AppBundle\Repository;


class JiraUser
{
    private $username;
    private $email;

    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}