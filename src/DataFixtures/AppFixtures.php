<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setNomcomplet('Abdou Ndiaye');           
        // $user->setRole('1');        
        $user->setUsername('Admin_Sys');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin'));
        $user->setRoles(json_encode(array("ROLE_SUPER_ADMIN"))); 
        $user->setStatut(true);       

        $manager->persist($user);

        $user1 = new User();
        $user1->setNomcomplet('Amadou Gueye');                   
        $user1->setUsername('Admin1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin1'));
        $user1->setRoles(json_encode(array("ROLE_ADMIN"))); 
        $user1->setStatut(true);

        $manager->persist($user1) ;

        $user2 = new User();
        $user2->setNomcomplet('Amadou Sarr');                   
        $user2->setUsername('caissier1');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'caissier1'));
        $user2->setRoles(array("ROLE_USER")); 
        $user2->setStatut(true);
        ;
        $manager->persist($user2);

        $manager->flush();
    }
}
