<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Form\BeerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormularController extends AbstractController
{
    /**
     * @Route("beer/import", name="import_beer")
     */
    public function importBeer(Request $request, EntityManagerInterface $em){

        $beer = new Beer();
        $formBeer = $this->createForm(BeerType::class);
        $formBeer->handleRequest($request);

        if($formBeer->isSubmitted() && $formBeer->isValid()){
            return true;
        }

        return $this->render('forms/import_beer.html.twig', ['formBeer' => $formBeer->createView()]);
    }

}