<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username) 
    {
        // u = alias table user
        $qb = $this->createQueryBuilder('u');
        
        $qb
            ->where('u.username = :username')
            ->orWhere('u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
        ;
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    // Correspond au listener activity listener pour l'entité User
    public function getActive()
    {
        $delay = new \DateTime();
        $delay->setTimestamp(strtotime('2 minutes ago'));
 
        $qb = $this->createQueryBuilder('u')
            ->where('u.lastActivity > :delay')
            ->setParameter('delay', $delay)
        ;
 
        return $qb->getQuery()->getResult();
    }
    
}
