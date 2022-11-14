<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\TypeOfBeer;
use App\Repository\BeerRepository;
use App\Repository\TypeOfBeerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home(TypeOfBeerRepository $tobr, BeerRepository $beerRepo){
        $types = $tobr->findAll();
        $beers = $beerRepo->findBy([],['name'=>'ASC']);
        return $this->render('main/index.html.twig',[
            'types' => $types,
            'beers' => $beers
        ]);
    }

    /**
     * @Route("/ajax", name="recherche_ajax")
     */
    public function ajaxSearch(BeerRepository $beerRepository, TypeOfBeerRepository $typeRepository): Response{
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $typeIds = array();
        foreach($_POST as $key => $value){
            if($value == 'true'){
                array_push($typeIds, $key);
            }
        }
        $types = $typeRepository->findBy(['id'=>$typeIds]);
        $beers = array();
        foreach ($types as $type){
            if($beerRepository->findBeersByType($type) != null) {
                foreach ($beerRepository->findBeersByType($type) as $beer){
                    if(!in_array($beer, $beers)){
                        array_push($beers, $beer);
                    }
                }
            }
        }
        $jsonContent = $serializer->serialize($beers, 'json');
// https://stackoverflow.com/questions/13343533/using-entityrepositoryfindby-with-many-to-many-relations-will-lead-to-a-e-no
        //dd($beers);
        return new Response(json_encode($jsonContent));
    }

    function creatTypeOfBeer(EntityManagerInterface $em){
        $blonde = new TypeOfBeer();
        $blonde->setWording("Blonde");
        $brune = new TypeOfBeer();
        $brune->setWording("Brune");
        $blanche = new TypeOfBeer();
        $blanche->setWording("Blanche");
        $ambree = new TypeOfBeer();
        $ambree->setWording("Ambrée");
        $ipa = new TypeOfBeer();
        $ipa->setWording("IPA");
        $lager = new TypeOfBeer();
        $lager->setWording("Lager");
        $pils = new TypeOfBeer();
        $pils->setWording("Pils");
        $abbaye = new TypeOfBeer();
        $abbaye->setWording("Abbaye");
        $stout = new TypeOfBeer();
        $stout->setWording("Stout");
        $em->persist($blonde);
        $em->persist($brune);
        $em->persist($blanche);
        $em->persist($ambree);
        $em->persist($ipa);
        $em->persist($lager);
        $em->persist($pils);
        $em->persist($abbaye);
        $em->persist($stout);
        $em->flush();
    }

    function createServices(EntityManagerInterface $em){
        $pression = new Service();
        $pression->setWording('Pression');
        $bottle = new Service();
        $bottle->setWording('Bouteille');
        $can = new Service();
        $can->setWording('Canette');
        $em->persist($pression);
        $em->persist($bottle);
        $em->persist($can);
        $em->flush();
    }
}