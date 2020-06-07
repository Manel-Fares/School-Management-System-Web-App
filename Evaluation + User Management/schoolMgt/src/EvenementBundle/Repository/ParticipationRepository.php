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
    public  function partEvclbtop5($x){

        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(p.idparticipation) x','e.idevenement','e.image','c.nomclub')
            ->from(' EvenementBundle:Participation', 'p')
            ->innerJoin(' EvenementBundle:Evenement', 'e', 'where', 'e.idevenement =:ii')
            ->innerJoin(' EvenementBundle:Club', 'c', 'where', 'c.idclub =e.idclub')

            ->where('p.idevenement =:ii order by e.idevenement desc')
            ->setParameter('ii', $x)


        ;


        return $qb->getQuery()->getResult();

    }
    public  function testt($e,$u)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p.idparticipation')
            ->from(' EvenementBundle:Participation', 'p')
             ->where('p.idevenement=:ee')
            ->andWhere('p.iduser=:uu')
            ->setParameter('ee',$e)
            ->setParameter('uu',$u)



        ;


        return $qb->getQuery()->getResult();
    }

}