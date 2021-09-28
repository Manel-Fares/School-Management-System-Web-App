<?php


namespace ClassBundle\Repository;


class EmploisRepository extends  \Doctrine\ORM\EntityRepository
{



    public function findClasseDQL($name)
    {
        $Query=$this->getEntityManager()
            ->createQuery("select e from ClassBundle:Emplois e JOIN schoolBundle:Classe c with c.id=e.nameclas where c.name LIKE :name ")
            ->setParameter('name','%'.$name.'%');
        return $Query->getResult();
    }



}
