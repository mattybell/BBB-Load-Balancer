<?php

namespace BBBLoadBalancer\AdminBundle\Service;

use BBBLoadBalancer\AdminBundle\Document\Recording;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;

class RecordingService
{
    protected $dm;
    protected $validator;

    /**
     * Constructor.
     */
    public function __construct($dm, $validator)
    {
        $this->dm = $dm->getManager();
        $this->validator = $validator;
    }

    /**
     * Save the Recording
     */
    public function saveRecording($recording){
        // validate recording
        $errors = $this->validator->validate($recording);
        if($errors->count()){
            foreach($errors as $error){
                throw new ValidatorException($error->getMessage());
            }
        }

        $this->dm->persist($recording);
        $this->dm->flush();
    }

    /**
     * New Recording
     */
    public function newRecording(){
        $recording = new Recording();
        return $recording;
    }

    /**
     * Get recording by id
     */
    public function getRecordingById($args, $orders = array(), $limit = null, $skip = null){
        return $this->dm->getRepository('BBBLoadBalancerAdminBundle:Recording')->findBy($args, $orders, $limit, $skip);
    }

    /**
     * remove the Recording
     */
    public function removeRecording($recording){
        if (!$recording) {
            throw new NotFoundHttpException();
        }
        $recording->setDeleted(true);
        $this->dm->persist($recording);
        $this->dm->flush();
    }
}