<?php

namespace AppBundle\Repository;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class JiraUserProvider implements JiraUserProviderInterface {


    public function registerUser( $username, $password): bool
    {
        $url = 'http://localhost:8080/rest/api/2/user?username=' . $username;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        var_dump($curl);exit;
        $user_type_list = (curl_exec($curl));
        $userTypeArr = json_decode($user_type_list);

        echo $userTypeArr->name ;
    }

}