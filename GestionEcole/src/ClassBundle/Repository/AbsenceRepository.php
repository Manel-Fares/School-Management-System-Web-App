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

}
