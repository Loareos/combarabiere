<?php

namespace App\Controller;

use App\Entity\Bar;
use App\Entity\Beer;
use App\Entity\Brewery;
use App\Entity\Menu;
use App\Entity\Pricing;
use App\Form\BarType;
use App\Form\BeerType;
use App\Form\CsvImportType;
use App\Form\PricingType;
use App\Repository\BreweryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
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
    public function importBeer(Request $request, EntityManagerInterface $em, BreweryRepository $br): Response{

        $beer = new Beer();
        $formBeer = $this->createForm(BeerType::class, $beer);
        $formBeer->handleRequest($request);

//        $formCsv = $this->createForm(CsvImportType::class);
//        $formCsv->handleRequest($request);


        if($formBeer->isSubmitted() && $formBeer->isValid()){
            $em->persist($beer);
            $em->flush();
        }

        return $this->renderForm('forms/import_beer.html.twig', [
            'formBeer' => $formBeer,
 //           'formCsv' => $formCsv
        ]);
    }

    /**
     * @Route("/bar", name="bar")
     */
    public function importBar(Request $request, EntityManagerInterface $em): Response{
        $bar = new Bar();
        $formBar = $this->createForm(BarType::class, $bar);
        $formBar->handleRequest($request);

        if($formBar->isSubmitted() && $formBar->isValid()){
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


    /*
        IMPORT CSV BRASSERIES

            if($formCsv->isSubmitted() && $formCsv->isValid()){
            $file = $formCsv->get('champ')->getData();
            if($file){
                $newFileName = 'fichier-brasserie.csv';
                $file->move($this->getParameter('upload_csv_dir'), $newFileName);
                $handle = fopen($this->getParameter('upload_csv_dir')."/".$newFileName, 'r');
                $tour=0;
                $name=null;
                $adress=null;
                $city=null;
                $country=null;
                $website=null;
                $description=null;

                while(($data = fgetcsv($handle)) !== false){
                    if($tour == 0){
                        foreach ($data as $key => $value){
                            if($value == 'name'){$name=$key;}
                            if($value == 'address1'){$adress=$key;}
                            if($value == 'city'){$city=$key;}
                            if($value == 'country'){$country=$key;}
                            if($value == 'website'){$website=$key;}
                        }
                    }else{
                        $brewery = new Brewery();
                        $brewery
                            ->setName($data[$name])
                            ->setAdress($data[$adress])
                            ->setCity($data[$city])
                            ->setCountry($data[$country])
                            ->setWebsite($data[$website]);
                        $em->persist($brewery);
                    }
                    $tour++;
                }
                $em->flush();
                $fileSys = new Filesystem();
                $fileSys->remove($this->getParameter('upload_csv_dir')."/".$newFileName);
            }
        }
==================================================
    IMPORT BIERE

            if($formCsv->isSubmitted() && $formCsv->isValid()){
            $file = $formCsv->get('champ')->getData();
            if($file){
                $newFileName = 'fichier-biere.csv';
                $file->move($this->getParameter('upload_csv_dir'), $newFileName);
                $handle = fopen($this->getParameter('upload_csv_dir')."/".$newFileName, 'r');
                $tour=0;
                $name=null;
                $alcool=null;
                $description=null;
                $brewery=null;

                while(($data = fgetcsv($handle)) !== false){
                    if($tour == 0){
                        foreach ($data as $key => $value){
                            if($value == 'name'){$name=$key;}
                            if($value == 'brewery_id'){$brewery=$key;}
                            if($value == 'abv'){$alcool=$key;}
                            if($value == 'descript'){$description=$key;}
                        }
                    }else{
                        $beer = new Beer();
                        $beer
                            ->setName($data[$name])
                            ->setAlcool($data[$alcool]/100)
                            ->setDescription($data[$description])
                            ->setBrewery($br->find($data[$brewery]+1));
                        $em->persist($beer);
                    }
                    $tour++;
                }
                $em->flush();
                $fileSys = new Filesystem();
                $fileSys->remove($this->getParameter('upload_csv_dir')."/".$newFileName);
            }
        }



     */

}