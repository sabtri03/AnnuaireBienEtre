<?php

namespace App\DataFixtures;

use App\Entity\Internship;
use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InternshipFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //creation by doctrine fixture of 10 new services
        for($i = 1; $i < 11; $i++){
            $internship = new Internship();
            $internship->setShowDate(new \Datetime());
            $internship->setShowUntil(new \Datetime());
            $internship->setBegin(new \Datetime());
            $internship->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ipsum et sapien luctus');
            $internship->setEnd(new \DateTime());
            $internship->setMoreInfo('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ipsum et sapien luctus');
            $internship->setName('Nom Internship '.$i);
            $internship->setPrice(rand(10,120));

            //get back the Object Provider from ProviderFixtures
            $provider =$this->getReference(ProviderFixtures::PROVIDER_REFERENCE);
            $internship->setOrganizer($provider);

            $manager->persist($internship);

        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            ProviderFixtures::class,
        );
    }
}
