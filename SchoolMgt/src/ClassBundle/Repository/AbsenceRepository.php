<?php


namespace ClassBundle\Repository;


class AbsenceRepository extends  \Doctrine\ORM\EntityRepository
{

    public function Search($word){


        $qry=$this->createQueryBuilder('m')
            ->where('m.id LIKE :param')
      //      ->orwhere('m.id LIKE :param')
//            ->orwhere('m.prix LIKE :param')
//            ->orwhere('m.type LIKE :param')
           // ->orwhere('m.description LIKE :param')
            ->setParameter('param', '%'.$word.'%');
        return $qry->getQuery()->getResult();

    }

    public function findAbsenceDQL($name)
    {
        $Query=$this->getEntityManager()
            ->createQuery("select a from ClassBundle:Absence a JOIN schoolBundle:Users u with u.id=a.idUser where u.nomuser LIKE :name ")

        ->setParameter('name','%'.$name.'%');
        return $Query->getResult();
    }

    public function findAbsenceLiveDQL($name)
    {
        $Query=$this->getEntityManager()
            ->createQuery("select a from ClassBundle:Absence a JOIN schoolBundle:Matier u with u.id=a.idMatiere where u.nom LIKE :name ")

            ->setParameter('name','%'.$name.'%');
        return $Query->getResult();
    }



}
