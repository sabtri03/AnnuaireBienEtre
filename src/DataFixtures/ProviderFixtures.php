<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProviderFixtures extends Fixture implements DependentFixtureInterface
{
    //Constant use to connect the ProviderFixtures to the InternshipFixtures
    public const PROVIDER_REFERENCE = "provider-ref";

    //password encoding
    private $passwordEncoder ;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //create an object to inject all the services in it => obj add services to a Provider
        //$internship = new Provider();

        //creation by doctrine fixtur of 10 new servicesUser
        for($i = 1; $i < 11; $i++){
            $provider = new Provider();
            $provider->setEmailContact($i.'@company.com');
            $provider->setName('Nom '.$i);
            $provider->setPhoneNumb('0032 '.$i);
            $provider->setTvaNumb('0000'.$i);
            $provider->setWebsite('#');

            $provider->setEmail($i.'provider'.rand(0,5000).'@hotmail.com');
            $provider->setAdresseStreet('Rue numero '.rand(0,20));
            $provider->setBanned(0);
            $provider->setInscrActivated(1);
            $provider->setInscriDate(new \Datetime());
            $provider->setAdresseNum(rand(0,400));
            $provider->setRoles(array('ROLE_PROVIDER'));
            //password encoded with the previous encoding
            $provider->setPassword($this->passwordEncoder->encodePassword(
                $provider,
                $i.'Password'
            ));
            $provider->setUnsucessfulTry(0);

            //get back the object codePostal to inject it to worker
            $cps = $this->getReference(AdresseFixtures::CP_REFERENCE);
            $provider->setAdresseCP($cps);
            //get back the object localite to inject it to worker
            $locality = $this->getReference(AdresseFixtures::LOCALITE_REFERENCE);
            $provider->setAdresseLocality($locality);
            //get back the object City to inject it to worker
            $city = $this->getReference(AdresseFixtures::CITY_REFERENCE);
            $provider->setAdresseCity($city);

            //creation of the Object Picture for the Logo
            $pictureLogo = new Picture();
            $pictureLogo->setPicture('https://via.placeholder.com/140x100?text=Logo');
            $pictureLogo->setRank(1);
            $provider->addLogo($pictureLogo);

            //get back the Object Services from serviceFixture
            $service =$this->getReference(ServiceFixtures::SERVICES_REFERENCE);
            $provider->addCategory($service);

            $manager->persist($provider);

            //add the services to the object that will be send to Internship via addReference()
            //$internship->$i= $provider;

        }
        $manager->flush();

        // other fixtures can get this object using the ProviderFixtures::PROVIDER_REFERENCE constant
        $this->addReference(self::PROVIDER_REFERENCE, $provider);
    }

    public function getDependencies()
    {
        return array(
            ServiceFixtures::class,
            AdresseFixtures::class,
        );
    }
}
