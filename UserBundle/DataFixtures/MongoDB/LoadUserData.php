<?php

namespace OpenOrchestra\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\UserBundle\Document\User;

/**
 * Class LoadUserData
 */
class LoadUserData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $nicolas = $this->generate('nicolas', 'ROLE_FROM_PUBLISHED_TO_DRAFT');
        $nicolas->addRole('ROLE_FROM_DRAFT_TO_PENDING');
        $nicolas->addRole('ROLE_FROM_PENDING_TO_PUBLISHED');
        $manager->persist($nicolas);

        $benjamin = $this->generate('benjamin', 'ROLE_FROM_DRAFT_TO_PENDING');
        $manager->persist($benjamin);

        $noel = $this->generate('noel', 'ROLE_FROM_PENDING_TO_PUBLISHED');
        $manager->persist($noel);

        $manager->flush();
    }

    /**
     * @return User
     */
    protected function generate($name, $mainRole)
    {
        $user = new User();

        $user->setUsername($name);
        $user->setPlainPassword($name);
        $user->addRole('ROLE_ADMIN');
        $user->addRole('ROLE_USER');
        $user->addRole($mainRole);
        $user->setEnabled(true);

        return $user;
    }
}
