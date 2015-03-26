<?php

namespace OpenOrchestra\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use FOS\UserBundle\Model\UserInterface;
use OpenOrchestra\UserBundle\Model\ApiClientInterface;
use OpenOrchestra\UserBundle\Model\TokenInterface;

/**
 * Class AccessTokenRepository
 */
class AccessTokenRepository extends DocumentRepository
{
    /**
     * @param ApiClientInterface $client
     *
     * @return TokenInterface
     */
    public function findOneByClientWithoutUser(ApiClientInterface $client)
    {
        return $this->findOneBy(array());
    }

    /**
     * @param TokenInterface $accessToken
     */
    public function save(TokenInterface $accessToken)
    {
        $this->revokeNonUsedAccessToken($accessToken->getClient(), $accessToken->getUser());

        $dm = $this->getDocumentManager();
        $dm->persist($accessToken);
        $dm->flush($accessToken);
    }

    /**
     * @param ApiClientInterface $client
     * @param UserInterface      $user
     */
    public function revokeNonUsedAccessToken(ApiClientInterface $client, UserInterface $user = null)
    {
        $searchParams = array(
            'client'  => $client->getId(),
            'blocked' => false
        );
        $searchParams['user'] = null;
        $searchParams['customer'] = null;
        if ($user instanceof UserInterface) {
            $searchParams['user'] = $user->getId();
        }

        $accessTokens = $this->findBy($searchParams);

        $dm = $this->getDocumentManager();

        /** @var TokenInterface $accessToken */
        foreach ($accessTokens as $accessToken) {
            $accessToken->block();
            $dm->persist($accessToken);
        }
        $dm->flush();
    }
}
