<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/18/2018
 * Time: 10:41 PM
 */

namespace AppBundle\Security\Firewall;

use AppBundle\Repository\JiraUserProviderInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class JiraListener implements ListenerInterface
{

    protected $jiraUserProvider;
    protected $userProvider;
    protected $userManager;

    public function __construct(JiraUserProviderInterface $jiraUserProvider, UserProviderInterface $userProvider, UserManagerInterface $userManager)
    {
        $this->jiraUserProvider = $jiraUserProvider;
        $this->userProvider = $userProvider;
        $this->userManager = $userManager;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        if (null === $username || null === $password) {
            return;
        }

        $jiraUser = $this->jiraUserProvider->loadUser($username, $password);

        try {
            if (null !== $jiraUser) {
                $this->userProvider->loadUserByUsername($username);

                //todo: password change and other fields
            }
        } catch (UsernameNotFoundException $exception) {
            $user = $this->userManager->createUser();
            $user->setUsername($username);
            $user->setEmail($jiraUser->getEmail());
            $user->setPlainPassword($request->request->get('_password'));
            $user->setEnabled(true);

            $this->userManager->updateUser($user);
        }
    }

}