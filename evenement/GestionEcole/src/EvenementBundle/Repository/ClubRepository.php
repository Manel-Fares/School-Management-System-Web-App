<?php


namespace EvenementBundle\Repository;


class ClubRepository extends  \Doctrine\ORM\EntityRepository
{

        public function search($x){
$qry=$this->getEntityManager()
->createQuery("SELECT m FROM EvenementBundle:Club m where m.nomclub like :k or m.domaine like :k ORDER BY m.nomclub ASC ")
->setParameter('k','%'.$x.'%');
return $qry->getResult();
}
    public function afficerSpecifique(){
        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.image  FROM EvenementBundle:Club m ");
        return $qry->getResult();
    }
//select nomClub,COUNT(evenement.idClub) nbr from club INNER JOIN evenement on club.idClub=evenement.idClub where evenement.idClub ='" + idd + "'
    public function nbrEvenementClub($o){
            //$x=123;
        /*$qry=$this->getEntityManager()
            ->createQuery("SELECT m FROM EvenementBundle:Club m JOIN  EvenementBundle:Evenement e WHERE  m.idClub = : e.idClub ");
        return $qry->getResult();*/
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.nomclub','COUNT(p.idclub) x')

            ->from(' EvenementBundle:Club', 'u')
            ->innerJoin('EvenementBundle:Evenement', 'p', 'where', 'p.idclub = :ii')
            ->setParameter('ii',$o);
var_dump($o);

        return $qb->getQuery()->getResult();

    }

}