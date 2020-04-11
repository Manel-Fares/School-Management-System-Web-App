<?php


namespace EvenementBundle\Repository;


class DemandeevenementRepository extends \Doctrine\ORM\EntityRepository
{
    public function budgetEvenementClub($o){
$e="valide";
        $qb = $this->_em->createQueryBuilder();
        $qb->select(' Sum(p.budget) x')
            ->from(' EvenementBundle:Demandeevenement', 'p')
            ->where('p.idclub = :ii ')
            ->setParameter('ii',$o)
            ->andWhere('p.etat = :m ')
            ->setParameter('m',$e)
           ;

        var_dump($o);

        return $qb->getQuery()->getResult();

    }
    public function budgetEvenementTotale(){
        $e="valide";
        $qb = $this->_em->createQueryBuilder();
         $qb->select(' Sum(p.budget) x')
            ->from(' EvenementBundle:Demandeevenement', 'p')
            ->Where('p.etat=:pp')
            ->setParameter('pp',$e);



        return $qb->getQuery()->getResult();

    }
public  function top3(){

    $qb = $this->_em->createQueryBuilder();
    $qb->select('u.nomclub as nom' ,'Sum(p.budget) as x')
        ->from(' EvenementBundle:Club', 'u')
        ->innerJoin('EvenementBundle:Demandeevenement', 'p', 'where', 'p.idclub = u.idclub')
        ->setMaxResults(3)
    ;


    return $qb->getQuery()->getResult();

}

}