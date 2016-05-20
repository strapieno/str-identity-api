<?php

namespace Strapieno\Identity\Api\V1;

use Matryoshka\Model\Object\ActiveRecord\ActiveRecordInterface;
use Matryoshka\Model\Object\IdentityAwareInterface;
use Strapieno\Auth\Api\Identity\IdentityInterface;
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
use ZF\ContentNegotiation\ViewModel;
use ZF\Hal\Entity;
use ZF\MvcAuth\Identity\GuestIdentity;
use ZF\Rpc\RpcController as ApigilityRpcController;

/**
 * Class RpcController
 */
class RpcController extends ApigilityRpcController
{
    /**
     * @param MvcEvent $e
     * @return ApiProblemModel|ViewModel
     */
    public function getIdentity(MvcEvent $e)
    {
        $identity = $e->getApplication()->getServiceManager()->get('api-identity');

        if ($identity instanceof GuestIdentity) {
            return new ApiProblemModel(new ApiProblem(404, 'Identity not found'));
        }

        if (!$identity instanceof IdentityInterface) {
            throw new \DomainException(
                sprintf(
                    'Invalid identity given %s expected %s',
                    is_object($identity) ? get_class($identity) : gettype($identity),
                    'Strapieno\Auth\Api\Identity\IdentityInterface'
                )
            );
        }

        $identityObject = $identity->getAuthenticationObject();

        if ($identityObject) {

            if (!$identityObject instanceof IdentityAwareInterface) {
                throw new \DomainException(
                    sprintf(
                        'Invalid identityObject given %s expected %s',
                        is_object($identityObject) ? get_class($identityObject) : gettype($identityObject),
                        'Matryoshka\Model\Object\IdentityAwareInterface'
                    )
                );
            }

            return new ViewModel(['payload' => new Entity($identityObject, $identityObject->getId())]);
        }

        return new ApiProblemModel(new ApiProblem(404, 'Identity not found'));
    }
}