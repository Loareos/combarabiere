<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\TypeOfBeer;
use App\Repository\TypeOfBeerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home(TypeOfBeerRepository $tobr){
        $types = $tobr->findAll();
//        $file_json = file_get_contents("https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=formatted_address%2Cname%2Crating%2Copening_hours%2Cgeometry&input=Museum%20of%20Contemporary%20Art%20Australia&inputtype=textquery&key=AIzaSyCVCX-63LKdL3Ak7GsECG-sRyHlNAZHR7Y");
//        echo($file_json);

     //   $file_json = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?keyword=bar&location=47.3942363%2C0.6821045&radius=500&type=bar&key=AIzaSyDeitFrhebI0BSSfu0XnMJFT1C6kZ9JPts");
     //   echo ($file_json);
/*        $query = file_get_contents('http://ip-api.com/json/');
        echo ($query);
        $query = json_decode($query, true);
*//*        if ($query && $query['status'] == 'success') {
            echo 'Hey user from ' . $query['country'] . ', ' . $query['city'] . '!';
        }
        foreach ($query as $data) {
            echo $data . "<br>";
        }
 */

        return $this->render('main/index.html.twig',[
            'types' => $types
        ]);
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