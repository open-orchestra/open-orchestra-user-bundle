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
        $nicolas = new User();

        $nicolas->setUsername($name);
        $nicolas->setPlainPassword($name);
        $nicolas->addRole('ROLE_ADMIN');
        $nicolas->addRole('ROLE_USER');
        $nicolas->addRole($mainRole);
        $nicolas->setEnabled(true);

        return $nicolas;
    }
}
