<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{

    //Constant use to connect the ServiceFixtures to the ProviderFixtures
        public const SERVICES_REFERENCE = "Services-ref";

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        //create an object to inject all the services in it => obj add services to a Provider
            $provider = new Service();

        //creation by doctrine fixture of 10 new services
        for($i = 1; $i < 11; $i++){
            $service = new Service();
            $service->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ipsum et sapien luctus, posuere hendrerit ex sodales.');
            $service->setName('Service'.$i);
            $service->setInFront(0);
            $service->setValidity(0);
            //$services->addPropose('Services_'.id, $services);
            $manager->persist($service);

            //add the services to the object that will be send to worker via addReference()
                //$provider->$i = $service;
        }
        $manager->flush();

        // other fixtures can get this object using the ServiceFixtures::CP_REFERENCE constant
            $this->addReference(self::SERVICES_REFERENCE, $service);
    }
}
