<?php


namespace EvenementBundle\Repository;


class ParticipationRepository  extends \Doctrine\ORM\EntityRepository
{
    public  function partEvclb($x){

        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(p.idparticipation) x','e.idevenement','e.image','e.datedebut','e.datefin','c.image as img')

            ->from(' EvenementBundle:Participation', 'p')
            ->innerJoin(' EvenementBundle:Evenement', 'e', 'where', 'e.idevenement =:ii')
            ->innerJoin(' EvenementBundle:Club', 'c', 'where', 'c.idclub =e.idclub')
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
        $qb->select('p,u,e')
            ->from(' EvenementBundle:Participation', 'p')
            ->innerJoin('EvenementBundle:Evenement', 'e', 'where', 'e.idevenement=:ee')
            ->innerJoin('schoolBundle:Users', 'u', 'where', 'u.id =:uu')
             ->where('p.idevenement=:ee')
            ->andWhere('p.iduser=:uu')
            ->setParameter('ee',$e)
            ->setParameter('uu',$u)



        ;


        return $qb->getQuery()->getResult();
    }
    public  function notpart($u)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(' e.idevenement')
            ->from(' EvenementBundle:Participation', 'p')
            ->innerJoin('EvenementBundle:Evenement', 'e', 'where', 'e.idevenement=p.idevenement')
            ->innerJoin('schoolBundle:Users', 'u', 'where', 'u.id =p.iduser')
            ->where('p.idevenement=p.idevenement')
            ->andWhere('p.iduser =:uu')
            ->setParameter('uu',$u)
     ;


        return $qb->getQuery()->getResult();
    }

}