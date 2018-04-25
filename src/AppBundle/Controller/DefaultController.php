<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\SearchTrip;
use AppBundle\Form\SearchTripType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $search = new SearchTrip();

      $form = $this->createForm(SearchTripType::class, $search);

      if ($request->isMethod('POST')) {
        $form->handleRequest($request);

        if ($form->isValid()) {
          //$search->setIdDest(1);
          $search->setSessionId($request->getSession()->getId());
          $em = $this->getDoctrine()->getManager();
          $em->persist($search);
          $em->flush();

          return $this->redirectToRoute('homepage');
        }
      }

      return $this->render('index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
          'form' => $form->createView(),
      ]);
    }
}
