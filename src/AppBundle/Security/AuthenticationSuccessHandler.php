<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationSuccessHandler
  extends DefaultAuthenticationSuccessHandler
  implements AuthenticationSuccessHandlerInterface
{

    private $router;

    public function __construct(HttpUtils $httpUtils, array $options = array(), RouterInterface $router)
    {
        parent::__construct($httpUtils, $options);

        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if($request->isXmlHttpRequest()){
            return new JsonResponse(array('success' => true));
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}
