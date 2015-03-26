<?php

namespace OpenOrchestra\UserBundle\Document;


/**
 * Trait Expireable
 */
trait Expireable
{
    /**
     * @var \DateTime $expired
     *
     * @ODM\Date
     */
    protected $expiredAt;

    /**
     * @param \DateTime $expiredAt
     */
    public function setExpiredAt(\DateTime $expiredAt)
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * @return boolean
     */
    public function isExpired()
    {
        if (null == $this->expiredAt) {
            return false;
        }

        return new \DateTime() > $this->expiredAt;
    }
}
