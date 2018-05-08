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
        $menu = $this->factory->createItem('root',array('childrenAttributes' => array('class' => 'navbar-nav ml-auto')));

        $menu->addChild('layout.register',
          array('attributes' => array('divider_append_2' => true),
            'linkAttributes' =>  array('class' => 'connect-modal'),
            'route' => 'fos_user_registration_register')
        )->setExtra('translation_domain', 'FOSUserBundle');

        if ($this->authorization_checker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $profile_picture=$this->token_storage->getToken()->getUser()->getProfilePicture();
            $label=$profile_picture?'<img class="rounded-circle fb-pic" src="'.$profile_picture.'"/>':$this->token_storage->getToken()->getUser()->getFirstName();
            $profile=$menu->addChild($label,
              array('attributes' => array('dropdown' => true),
                'uri' => 'javascript:void(0)',
                'linkAttributes' => array('class' => $profile_picture?'header-nav-pic':null)
              )
            )->setExtra('safe_label', true );

            // Edit profile
            $profile->addChild('profile.edit',
              array('route' => 'fos_user_profile_edit',
                'attributes' => array('divider_prepend' => true, 'divider_append' => true)
              )
            );

            // Log out
            $profile->addChild('layout.logout',
              array('route' => 'fos_user_security_logout',
                'attributes' => array('icon' => 'fa fa-sign-out')
              )
            )->setExtra('translation_domain', 'FOSUserBundle');
        }
        else {
/*            $menu->addChild('layout.login',
              array('route' => 'fos_user_security_login')
            )->setExtra('translation_domain', 'FOSUserBundle');*/

            $menu->addChild('layout.login',
              //array('linkAttributes' =>  array('data-toggle' => 'modal', 'data-target' => '#modalLogin'),
              array('linkAttributes' =>  array('class' => 'connect-modal'),
                'route' => 'fos_user_security_login')
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
