<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    protected $factory;
    protected $authorization_checker;
    protected $token_storage;

    public function __construct(FactoryInterface $factory, $authorization_checker, $token_storage)
    {
        $this->factory = $factory;
        $this->authorization_checker = $authorization_checker;
        $this->token_storage = $token_storage;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('layout.register',
          array('route' => 'fos_user_registration_register',
            'attributes' => array('class' => 'header-nav-li'),
            'linkAttributes' => array('class' => 'header-nav-text')
          )
        )->setExtra('translation_domain', 'FOSUserBundle');

        if ($this->authorization_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $profile_picture='<img class="img-round mod-avatar" src="'.$this->token_storage->getToken()->getUser()->getProfilePicture().'"/>';
            $menu->addChild($profile_picture,
              array('attributes' => array('class' => 'header-nav-li','dropdown' => true),
                'linkAttributes' => array('class' => 'header-nav-text')
              )
            )->setExtra('safe_label', true );
            $profile=$menu->getChild($profile_picture);
            $profile->setChildrenAttribute('class','test');

            // Edit profile
            $profile->addChild('profile.edit',
              array('route' => 'fos_user_profile_edit',
                'attributes' => array('class' => 'header-nav-sub-li'),
                'linkAttributes' => array('class' => 'header-nav-sub-text')
              )
            );

            // Log out
            $profile->addChild('layout.logout',
              array('route' => 'fos_user_security_logout',
                'attributes' => array('class' => 'header-nav-sub-li'),
                'linkAttributes' => array('class' => 'header-nav-sub-text')
              )
            )->setExtra('translation_domain', 'FOSUserBundle');;
        }
        else {
            $menu->addChild('layout.login',
              array('route' => 'fos_user_security_login',
                'attributes' => array('class' => 'header-nav-li'),
                'linkAttributes' => array('class' => 'header-nav-text')
              )
            )->setExtra('translation_domain', 'FOSUserBundle');
        }

        return $menu;
    }
}
