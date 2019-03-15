<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Surfer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SurferFixtures extends Fixture implements DependentFixtureInterface
{
    //password encoding
    private $passwordEncoder ;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        //creation by doctrine fixtur of 10 new Surfer
        for($i = 1; $i < 11; $i++) {
            $surfer = new Surfer();
            $surfer->setName('Nom '.$i);
            $surfer->setSurname('Prenom '.$i);
            $surfer->setNewsletter(0);

            $surfer->setEmail($i.'surfer'.rand(0,5000).'@hotmail.com');
            $surfer->setAdresseStreet('Rue numero '.rand(0, 20));
            $surfer->setBanned(0);
            $surfer->setInscrActivated(1);
            $surfer->setInscriDate(new \Datetime());
            $surfer->setAdresseNum(rand(0, 400));
            $surfer->setRoles(array('ROLE_USER'));

            //password encoded with the previous encoding
            $surfer->setPassword($this->passwordEncoder->encodePassword(
                $surfer,
                $i . 'Password'
            ));
            $surfer->setUnsucessfulTry(0);

            // other fixtures can get this object using the AdresseFixtures::CP_REFERENCE  constant et AdresseFixtures::LOCALITE_REFERENCE  constant

            $cps = $this->getReference(AdresseFixtures::CP_REFERENCE);
            $surfer->setAdresseCP($cps);
            $city = $this->getReference(AdresseFixtures::CITY_REFERENCE);
            $surfer->setAdresseCity($city);
            $locality = $this->getReference(AdresseFixtures::LOCALITE_REFERENCE);
            $surfer->setAdresseLocality($locality);

            //creation of the Object Picture for the Logo
            $pictureAvatar = new Picture();
            $pictureAvatar->setPicture('https://via.placeholder.com/140x100?text=Logo');
            $pictureAvatar->setRank(1);
            $surfer->setAvatar($pictureAvatar);


            $manager->persist($surfer);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            AdresseFixtures::class,
        );
    }
}
