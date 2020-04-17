<?php


namespace EvenementBundle\Repository;


class DemandeevenementRepository extends \Doctrine\ORM\EntityRepository
{
    public function budgetEvenementClub($o)
    {
        $e = "valider";
        $qb = $this->_em->createQueryBuilder();
        $qb->select(' Sum(p.budget) x')
            ->from(' EvenementBundle:Demandeevenement', 'p')
            ->where('p.idclub = :ii ')
            ->setParameter('ii', $o)
            ->andWhere('p.etat = :m ')
            ->setParameter('m', $e);

        // var_dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();

    }

    public function budgetEvenementTotale()
    {
        $e = "valider";
        $qb = $this->_em->createQueryBuilder();
        $qb->select(' Sum(p.budget) x')
            ->from(' EvenementBundle:Demandeevenement', 'p')
            ->Where('p.etat=:pp')
            ->setParameter('pp', $e);


        return $qb->getQuery()->getResult();

    }

    public function idclb()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.idclub as idd')
            ->distinct('u.idclub')

            ->from(' EvenementBundle:Club', 'u')
            ->innerJoin('EvenementBundle:Demandeevenement', 'p', 'where', 'p.idclub = u.idclub');



return $qb->getQuery()->getResult();
}
            public  function top3($x){
$ee="valider";
    $qb = $this->_em->createQueryBuilder();
    $qb->select('u.nomclub as nom' ,'Sum(p.budget) as x')
        ->from(' EvenementBundle:Demandeevenement', 'p')
        ->innerJoin('EvenementBundle:club', 'u', 'where', 'u.idclub = :xx')
       // ->where('p.etat=:e')
       ->orderBy('p.idclub', 'DESC')
      ->Where('p.idclub = :xx')

        ->setParameter('xx',$x)
       // ->setParameter('e',$ee)

 ->setMaxResults(3)
    ;


    return $qb->getQuery()->getResult();

}

}