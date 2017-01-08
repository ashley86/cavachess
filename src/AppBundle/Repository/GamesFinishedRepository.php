<?php

namespace AppBundle\Repository;

/**
 * GamesFinishedRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GamesFinishedRepository extends \Doctrine\ORM\EntityRepository
{
    public function findGamesWon($id){
        $qb = $this->createQueryBuilder('gf')
                ->innerJoin('gf.idwinner', 'u' )
                ->where('gf.idwinner = :id')
                ->setParameter('id', $id)
        ;
        
        return $qb->getQuery()->getResult();
    }
    
    public function findGamesLost($id){
        $qb = $this->createQueryBuilder('gf')
                ->innerJoin('gf.idlooser', 'u' )
                ->where('gf.idlooser = :id')
                ->setParameter('id', $id)
        ;
        
        return $qb->getQuery()->getResult();
    }
}
