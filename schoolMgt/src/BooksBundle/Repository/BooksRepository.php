<?php
/**
 * Created by PhpStorm.
 * User: Neifos
 * Date: 07/04/2020
 * Time: 20:21
 */

namespace BooksBundle\Repository;



class BooksRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByGroupingByCategorie($categorie)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(*),b.* as nbr FROM BooksBundle:Books b Group by b.categoriebook=:categorie'
            )->setParameter('categorie',$categorie)
            ->getResult();
    }

}