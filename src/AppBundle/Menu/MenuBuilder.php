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
            $profile_picture=$this->token_storage->getToken()->getUser()->getProfilePicture();
            $label=$profile_picture?'<img class="img-round mod-pic" src="'.$profile_picture.'"/>':$this->token_storage->getToken()->getUser()->getFirstName();
            $profile=$menu->addChild($label,
              array('attributes' => array('class' => 'header-nav-li dropdown'),
                'uri' => '#',
                'linkAttributes' => array('class' => $profile_picture?'header-nav-pic':'header-nav-text')
              )
            )->setExtra('safe_label', true );

            $profile->setChildrenAttribute('class','dropdown-menu');

            // Arrow
            $profile->addChild('',
              array('attributes' => array('class' => 'dropdown-arrow-top')
              )
            );

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
            )->setExtra('translation_domain', 'FOSUserBundle');
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

    public function createProfileMenu(array $options)
    {
        $menu = $this->factory->createItem('root',
          array('childrenAttributes'  => array('class' => 'profile-nav card'))
        );

        $menu->addChild('profile.edit',
          array('route' => 'fos_user_profile_edit')
        );

        $menu->addChild('Mon compte',
          array('route' => 'fos_user_profile_edit')
        )->setExtra('translation_domain', 'FOSUserBundle');


        return $menu;
    }
}
