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


}