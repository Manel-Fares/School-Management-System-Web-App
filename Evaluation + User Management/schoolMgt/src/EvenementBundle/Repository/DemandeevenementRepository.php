<?php


namespace EvenementBundle\Repository;
use schoolBundle\Entity\Users;


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




      ->Where('p.idclub = :xx')

        ->setParameter('xx',$x)
       // ->setParameter('e',$ee)


    ;


    return $qb->getQuery()->getResult();

}
    public function testt($x){

        $qry=$this->getEntityManager()
            //select nomClub,COUNT(evenement.idClub) nbr from club INNER JOIN evenement on club.idClub=evenement.idClub where evenement.idClub ='" + idd + "'
// demandeevenement p on p.idclub=m.idclub ORDER BY m.nomclub DESc
       //  ->createQuery("SELECT m.nomclub as nom,m.idclub as x FROM EvenementBundle:Club m   JOIN EvenementBundle:Demandeevenement p with p.idclub=m.idclub ORDER BY m.nomclub DESc");
           ->createQuery("SELECT m.idclub as nom,Sum(p.budget) as x  FROM EvenementBundle:Club m  JOIN EvenementBundle:Demandeevenement p with p.idclub=m.idclub where p.idclub=:xx ORDER BY x asc")
       ->setParameter('xx',$x);
        return $qry->getResult();
    }



}