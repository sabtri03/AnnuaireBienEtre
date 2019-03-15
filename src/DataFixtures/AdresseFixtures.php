<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Locality;
use App\Entity\PostalCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdresseFixtures extends Fixture
{
    //Constant use to connect the AdresseFixtures to the WorkerFixtures to share the CodePostal
    public const CP_REFERENCE = "cp-ref";
    //Constant use to connect the AdresseFixtures to the WorkerFixtures to share the Locality
    public const LOCALITE_REFERENCE = "Localite-ref";
    //Constant use to connect the AdresseFixtures to the WorkerFixtures to share the City
    public const CITY_REFERENCE = "City-ref";


    public function load(ObjectManager $manager)
    {

        //$cp = new PostalCode();
    //creation by doctrine fixtur of 10 new Code Postal
        for($i = 1; $i < 11; $i++) {
            $userCP = new PostalCode();
            $userCP->setPostalCode(rand(4000,4999));
            $manager->persist($userCP);
            //$cp->$i = $userCP;
        }
        $manager->flush();

        // other fixtures can get this object using the AdresseFixtures::CP_REFERENCE constant
        $this->addReference(self::CP_REFERENCE, $userCP);


    //creation by doctrine fixtur of 10 new Locality
        //$lc = new Locality();
        for($j = 1; $j < 11; $j++) {
            $adresseLocalite = new Locality();
            $adresseLocalite->setLocality('Loaclite'.$j);
            $manager->persist($adresseLocalite);
            //$lc->$j = $adresseLocalite;
        }
        $manager->flush();

        // other fixtures can get this object using the AdresseFixtures::Localite_REFERENCE constant
        $this->addReference(self::LOCALITE_REFERENCE, $adresseLocalite);


    //creation by doctrine fixtur of 10 new City
        //$ct = new City();
        for($p = 1; $p < 11; $p++) {
            $adresseCity = new City();
            $adresseCity->setCity('City'.$p);
            $manager->persist($adresseCity);
            //$ct->$p = $adresseCity;
        }
        $manager->flush();

        // other fixtures can get this object using the AdresseFixtures::City_REFERENCE constant
        $this->addReference(self::CITY_REFERENCE, $adresseCity);
    }

}
