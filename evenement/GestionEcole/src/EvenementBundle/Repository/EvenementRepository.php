<?php


namespace EvenementBundle\Repository;


class EvenementRepository extends  \Doctrine\ORM\EntityRepository
{
    public function afficerSpecifique(){
        $qry=$this->getEntityManager()
            ->createQuery("SELECT * FROM EvenementBundle:Evenement m ");
        return $qry->getResult();
    }


    public function EvenementProch(){
        $date= new \DateTime("now");

        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.idevenement,  m.datedebut, m.datefin,m.image FROM EvenementBundle:Evenement m where m.datedebut > :date")
            ->setParameter('date', $date->format('Y-m-d'));

        return $qry->getResult();
    }
}