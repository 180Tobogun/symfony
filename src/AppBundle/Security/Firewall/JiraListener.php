<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/18/2018
 * Time: 10:41 PM
 */

namespace AppBundle\Security\Firewall;


use AppBundle\Repository\JiraUserProvider;
use AppBundle\Repository\JiraUserProviderInterface;
use AppBundle\Security\Authentication\Token\JiraUserToken;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class JiraListener implements ListenerInterface
{
    protected $tokenStorage;
    protected $authenticationManager;
    protected $jiraUserProvider;

    public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager, JiraUserProviderInterface $jiraUserProvider)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->jiraUserProvider = $jiraUserProvider;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();


        $token = new JiraUserToken();
        $token->setUser($request->request->get('_username'));

//        $token->digest = $matches['digest'];
//        $token->nonce = $matches['nonce'];
//        $token->created = $matches['created'];

        try {
            $jiraUser = $this->jiraUserProvider->registerUser($request->request->get('_username'), $request->request->get('_password'));
var_dump($jiraUser);
            $authToken = $this->authenticationManager->authenticate($token);
            $this->tokenStorage->setToken($authToken);

            return;
//            return new RedirectResponse('/');
        } catch (AuthenticationException $failed) {
            // ... you might log something here

            // To deny the authentication clear the token. This will redirect to the login page.
            // Make sure to only clear your token, not those of other authentication listeners.
            // $token = $this->tokenStorage->getToken();
            // if ($token instanceof WsseUserToken && $this->providerKey === $token->getProviderKey()) {
            //     $this->tokenStorage->setToken(null);
            // }
            // return;
        }

        var_dump(1);exit;

        // By default deny authorization
        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        $event->setResponse($response);
    }

}