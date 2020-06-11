<?php


namespace EvenementBundle\Repository;
use schoolBundle\Entity\Users;


class EvenementRepository extends  \Doctrine\ORM\EntityRepository
{
    public function afficerSpecifique(){
        $date= new \DateTime("now");
        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.idevenement FROM EvenementBundle:Evenement m where m.datefin  > :date  OR m.datefin  > :date ")
        ->setParameter('date', $date->format('Y-m-d'));
        return $qry->getResult();
    }


    public function EvenementProch(){
        $date= new \DateTime("now");

        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.idevenement,  m.datedebut, m.datefin,m.image FROM EvenementBundle:Evenement m where DATE_DIFF(:date ,m.datefin)  < 7 OR  DATE_DIFF(:date ,m.datefin) = 7")
            ->setParameter('date', $date->format('Y-m-d'));

        return $qry->getResult();
    }
    public function nbrEvenementTotale(){


        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(p.idclub) nbr')

            ->from(' EvenementBundle:Evenement', 'p');

        return $qb->getQuery()->getResult();

    }
    public  function xx()
    {         $qry=$this->getEntityManager()

        ->createQueryBuilder('e')
        ->select('e.idclub ')
        ->where('e.idclub=:idResponsable')
        ->setParameter('idResponsable','111');
    }

    public function afficerSpecifiqueClub($x){
        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.idevenement,m.datedebut,m.datefin,m.image   FROM EvenementBundle:Evenement m where m.idclub = :x ")
        ->setParameter('x',$x);
        return $qry->getResult();
    }


}