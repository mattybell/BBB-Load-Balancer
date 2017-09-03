<?php

namespace BBBLoadBalancer\AdminBundle\Document;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="Recording")
 * @MongoDBUnique(fields="recordingId", message = "This recordingId is already in use")
 */
class Recording
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotBlank(message = "No recording ID")
     */
    protected $recordingId;

    /**
     * @MongoDB\ReferenceOne(targetDocument="BBBLoadBalancer\AdminBundle\Document\Meeting", simple=true)
     * @Assert\NotBlank(message = "No meeting given")
     */
    protected $meeting;

    /**
     * @MongoDB\ReferenceOne(targetDocument="BBBLoadBalancer\AdminBundle\Document\Server", simple=true)
     * @Assert\NotBlank(message = "No server given")
     */
    protected $server;
    
    /**
     * @MongoDB\Boolean
     * @Assert\Type(type="boolean", message="The value for deleted is not valid")
     */
    protected $deleted;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recordingId
     *
     * @param string $recordingId
     * @return self
     */
    public function setRecordingId($recordingId)
    {
        $this->recordingId = $recordingId;
        return $this;
    }

    /**
     * Get recordingId
     *
     * @return string $recordingId
     */
    public function getRecordingId()
    {
        return $this->recordingId;
    }

    /**
     * Set meeting
     *
     * @param BBBLoadBalancer\AdminBundle\Document\Meeting $meeting
     * @return self
     */
    public function setMeeting(\BBBLoadBalancer\AdminBundle\Document\Meeting $meeting)
    {
        $this->meeting = $meeting;
        return $this;
    }

    /**
     * Get meeting
     *
     * @return BBBLoadBalancer\AdminBundle\Document\Meeting $meeting
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set server
     *
     * @param BBBLoadBalancer\AdminBundle\Document\Server $server
     * @return self
     */
    public function setServer(\BBBLoadBalancer\AdminBundle\Document\Server $server)
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Get server
     *
     * @return BBBLoadBalancer\AdminBundle\Document\Server $server
     */
    public function getServer()
    {
        return $this->server;
    }
}
