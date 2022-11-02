<?php

namespace App\Controller;

use App\Entity\Bar;
use App\Entity\Beer;
use App\Entity\Menu;
use App\Entity\Pricing;
use App\Form\BarType;
use App\Form\BeerType;
use App\Form\PricingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/import", name="import_")
 */
class FormularController extends AbstractController
{
    /**
     * @Route("/beer", name="beer")
     */
    public function importBeer(Request $request, EntityManagerInterface $em): Response{

        $beer = new Beer();
        $formBeer = $this->createForm(BeerType::class, $beer);
        $formBeer->handleRequest($request);

        if($formBeer->isSubmitted() && $formBeer->isValid()){
            $em->persist($beer);
            $em->flush();
        }

        return $this->render('forms/import_beer.html.twig', ['formBeer' => $formBeer->createView()]);
    }

    /**
     * @Route("/bar", name="bar")
     */
    public function importBar(Request $request, EntityManagerInterface $em): Response{
        $bar = new Bar();
        /*        $menu = new Menu();
                $bar->setMenu($menu);
                $em->persist($menu);
                $em->persist($bar);
        */
        $formBar = $this->createForm(BarType::class, $bar);
        $formBar->handleRequest($request);

        if($formBar->isSubmitted() && $formBar->isValid()){
//            $em->persist($menu);
            $em->persist($bar);
            $em->flush();
        }

        return $this->renderForm('forms/import_bar.html.twig',[
            'formBar' => $formBar
        ]);
    }

    /**
     * @Route("/price", name="price")
     */
    public function importPrice(Request $request, EntityManagerInterface $em): Response{
        $price = new Pricing();
        $formPrice = $this->createForm(PricingType::class, $price);
        $formPrice->handleRequest($request);

        if($formPrice->isSubmitted() && $formPrice->isValid()){
            $menu = new Menu();
        }

        return $this->render('forms/import_pricings.html.twig',[
            'formPrice' => $formPrice->createView()
        ]);
    }


}