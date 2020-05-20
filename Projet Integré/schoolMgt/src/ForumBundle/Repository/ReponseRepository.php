<?php


namespace ForumBundle\Repository;


class ReponseRepository extends  \Doctrine\ORM\EntityRepository
{  public function findFF($titre){
    $qry=$this->getEntityManager()
        ->createQuery("SELECT COUNT (m) as qte FROM ForumBundle:Reponse m WHERE m.idQuestion = :tit")
        ->setParameter(':tit',$titre);
    return $qry->getResult();
}

}