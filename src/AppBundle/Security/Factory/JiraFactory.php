<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/18/2018
 * Time: 11:08 PM
 */

namespace AppBundle\Security\Factory;

use AppBundle\Security\Authentication\Provider\JiraProvider;
use AppBundle\Security\Firewall\JiraListener;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class JiraFactory implements SecurityFactoryInterface
{

    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.jira.'.$id;
        $container
            ->setDefinition($providerId, new ChildDefinition(JiraProvider::class))
            ->setArgument(0, new Reference($userProvider));

        $listenerId = 'security.authentication.listener.jira.'.$id;
        $container->setDefinition($listenerId, new ChildDefinition(JiraListener::class));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'jira';
    }

    public function addConfiguration(NodeDefinition $node)
    {
    }
}