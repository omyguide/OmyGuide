<?php

namespace AppBundle\Security;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(
        HttpKernelInterface $httpKernel,
        HttpUtils $httpUtils,
        array $options = array(),
        LoggerInterface $logger,
        FlashBagInterface $flashBag
    )
    {
        parent::__construct($httpKernel, $httpUtils, $options, $logger);

        $this->flashBag = $flashBag;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if($request->isXmlHttpRequest()){
            $message=$exception->getMessage();
            $this->flashBag->add('danger',$message);

            return new JsonResponse(array('success' => false, 'message' => $message));
        }

        return parent::onAuthenticationFailure($request, $exception);
    }
}
