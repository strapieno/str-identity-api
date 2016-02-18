<?php

namespace Strapieno\Identity\Api\V1;

use Matryoshka\Model\Object\ActiveRecord\ActiveRecordInterface;
use Strapieno\User\Model\Criteria\Mongo\UserMongoCollectionCriteria;
use Strapieno\User\Model\Entity\State\UserStateAwareInterface;
use Strapieno\User\Model\UserModelInterface;
use Strapieno\User\Model\UserModelService;
use Zend\Http\Response;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemModel;
use ZF\Rpc\RpcController as ApigilityRpcController;

/**
 * Class RpcController
 */
class RpcController extends ApigilityRpcController
{
    /**
     * @param MvcEvent $e
     */
    public function getIdentity(MvcEvent $e)
    {
        $identity = $app->getServiceManager()->get('api-identity');
        var_dump($identity); die();
    }
}