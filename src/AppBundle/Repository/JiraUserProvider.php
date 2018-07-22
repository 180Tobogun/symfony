<?php

namespace AppBundle\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class JiraUserProvider implements JiraUserProviderInterface
{


    public function loadUser($username, $password): ?JiraUser
    {
        $url = 'http://localhost:8080/rest/api/2/user?username=' . $username;
        $request = new Request('GET', $url);
        $request = $request->withHeader('Authorization', 'Basic ' . base64_encode($username . ':' . $password));
        $request = $request->withHeader('Content-Type', 'application/json');


        try {
            $client = new Client();
            $response = $client->send($request, ['timeout' => 1]);
            if (200 === $response->getStatusCode()){
                $data = \json_decode((string)$response->getBody(), true);

                return new JiraUser($username, $data['emailAddress']);
            }
            return null;
        } catch (ConnectException $exception) {

            return null;
        } catch (\Throwable $exception) {
            throw new UsernameNotFoundException();
        }

    }

}