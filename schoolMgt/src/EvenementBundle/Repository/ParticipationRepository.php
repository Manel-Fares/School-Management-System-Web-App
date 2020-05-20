<?php


namespace EvenementBundle\Repository;


class ParticipationRepository  extends \Doctrine\ORM\EntityRepository
{
    public  function partEvclb($x){

        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(p.idparticipation) x','e.idevenement','e.image','e.datedebut','e.datefin')
            ->from(' EvenementBundle:Participation', 'p')
            ->innerJoin(' EvenementBundle:Evenement', 'e', 'where', 'e.idevenement =:ii')
            ->where('p.idevenement =:ii')
            ->setParameter('ii', $x)


        ;


        return $qb->getQuery()->getResult();

    }

}