<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use App\Entity\Message;
use App\Entity\Carte;
use App\Entity\Menu;
use App\Entity\TypesDePlats;
use App\Entity\Plat;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->makeUtilisateurs($manager);
        $this->makeMessages($manager);
        $this->makeTypes($manager);
        $this->makePlats($manager);
        $this->makeMenus($manager);
        $this->makeCartes($manager);
        

    }

    public function makeUtilisateurs(ObjectManager $manager){

        $toto = new MessageDigestPasswordEncoder();

        $listeNames =["Legrand","Louis","Robin","Moreau","Leroux","Gonzalez","Poirier","Leroux","Jacquet","Aubert","Bailly","Guerin"];
        $listeRoles = ["admin","admin","user","user","user","user","user","user","user","user","user","user"];
        $listeEmails = ["rhoncus.id@neccursusa.net","malesuada@Sedet.ca","risus.Nunc@atvelitCras.edu","vel@Fuscealiquetmagna.edu","purus@risus.com","Maecenas.ornare.egestas@ategestas.ca","Mauris.magna.Duis@atauctorullamcorper.net","sagittis.placerat@Donecat.co.uk","nibh.lacinia@imperdiet.com","Fusce.fermentum.fermentum@interdum.edu","dis.parturient.montes@tempus.co.uk","non@Maurisnondui.net"];

        for($i = 0 ; $i < count($listeNames) ; $i++){

            $newObj = (new Utilisateur())->setLogin($listeNames[$i])
                ->setEmail($listeEmails[$i])
                ->setRole($listeRoles[$i])
                ->setPassword($toto->encodePassword("tutu", (new Utilisateur())->getSalt()));
            ;
            
            $manager->persist($newObj);
        }

        $manager->flush();

    }

    public function makeMessages(ObjectManager $manager){


        $listeMessages =["Super méga bon","Berk pas bon !!","Cuisine délicieuse","Equipe très sympa, service efficace","1h pour être servi, lamentable..."];
        $listeNotes = [5,0.5,4.5,3.5,1];
        $listeUsers = [2,3,4,5,6];
        $listeDates = ["2016-03-23 10:18","2016-06-04 11:07","2017-10-10 21:47","2017-05-15 23:21","2016-05-08 19:21"];

        for($i = 0 ; $i < count($listeMessages) ; $i++){

            $newObj = (new Message())->setMessage($listeMessages[$i])
                ->setUtilisateurId($manager->find(Utilisateur::class, $listeUsers[$i]))
                ->setNote($listeNotes[$i])
                ->setDateCreation(date_create_from_format('Y-m-d H:i', $listeDates[$i]))
            ;
            $manager->persist($newObj);
        }

        $manager->flush();
    }

    

    public function makeTypes(ObjectManager $manager){


        $listeNoms =["entrée","plat","dessert"];

        for($i = 0 ; $i < count($listeNoms) ; $i++){

            $newObj = (new TypesDePlats())->setIntitule($listeNoms[$i])
            ;
            $manager->persist($newObj);
        }

        $manager->flush();
    }

    public function makePlats(ObjectManager $manager){


        $listeNoms =["Hamburger","Pancakes","Buche de Noël","French Hot Dog","Poulet crispy","Tacos","Hamburger frites","Salade de crudités","Wok épicé","Gratin savoyard","Mochi","Salade de fruits","Café gourmand","Avocat Oeufs","Salade de riz","Soupe miso"];
        $listePrix = [5,2,4.9,2.9,3.5,3.5,8.9,2.90,6.9,6.9,2.9,2.8,1.9,2.30,1.9,1.9];
        $listeTypes =[2,3,3,1,1,1,2,1,2,2,3,3,3,1,1,1];
        $listeImages = ["burger.jpeg","pancakes.jpg","bucheNoel.jpg","frenchHot.jpg","crispyChicken.jpeg","tacos.jpeg","burgerFrites.jpg","salad.jpg","wok.jpg","gratinSavoyard.jpg","mochi.jpg","saladeFruits.png","cafeGourmand.jpeg","duoAvocatOeuf.jpg","saladeRiz.jpg","miso.jpeg"];
        
        for($i = 0 ; $i < count($listeNoms) ; $i++){

            $newObj = (new Plat())->setNom($listeNoms[$i])
                ->setPrix($listePrix[$i])
                ->setImage($listeImages[$i])
                ->setType($manager->find(TypesDePlats::class, $listeTypes[$i]))
            ;
            $manager->persist($newObj);
        }

        $manager->flush();
    }

    public function makeMenus(ObjectManager $manager){

        $listeNoms =["Noel","Fast food","Asiatique","French","Vegan"];
        $listeDescriptions = ["Menu de Noël","Menu riche en lipides","Saveurs de l\'Asie","menu bien de chez nous","Pas de viandes!"];
        $listePlats = [
            [15,10,3],[4,7,2],[15,9,11],[14,10,13],[8,10,12]
        ];

        for($i = 0 ; $i < count($listeNoms) ; $i++){

            $newObj = (new Menu())->setNom($listeNoms[$i])
                ->setDescription($listeDescriptions[$i])
            ;

            for($j = 0 ; $j < count($listePlats[$i]) ; $j++){
                $newPlat = $manager->find(Plat::class, $listePlats[$i][$j]);
                $newObj->addListePlat($newPlat);
            }
            $manager->persist($newObj);
        }

        $manager->flush();
    }

    public function makeCartes(ObjectManager $manager){


        $listeNoms =["Noel","Carte 2","Novembre 2017","Carte 4","Carte 5"];
        $listeDates = ["2016-11-23 10:18","2016-06-04 11:07","2017-10-30 21:47","2017-05-15 23:21","2016-05-08 19:21"];
        $listeOnline = [0,0,1,0,0];
        $listeMenus = [
            [1,4],[2,3,5],[1,5],[2,3,4,5],[2]
        ];

        for($i = 0 ; $i < count($listeNoms) ; $i++){

            $newObj = (new Carte())->setNom($listeNoms[$i])
                ->setDateCreation(date_create_from_format('Y-m-d H:i', $listeDates[$i]))
                ->setOnline($listeOnline[$i])
            ;

            for($j = 0 ; $j < count($listeMenus[$i]) ; $j++){
                $newPlat = $manager->find(Menu::class, $listeMenus[$i][$j]);
                $newObj->addListeMenu($newPlat);
            }
            $manager->persist($newObj);
        }

        $manager->flush();
    }
}
