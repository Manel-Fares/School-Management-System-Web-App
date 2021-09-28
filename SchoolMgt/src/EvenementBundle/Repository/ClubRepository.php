<?php


namespace EvenementBundle\Repository;


use blackknight467\StarRatingBundle\Form\RatingType;

class ClubRepository extends  \Doctrine\ORM\EntityRepository
{

    public function search($x){
        $qry=$this->getEntityManager()
            ->createQuery("SELECT m.idclub as idclub ,m.nomclub as nomclub, m.domaine  as domaine  FROM EvenementBundle:Club m where m.nomclub like :k or m.domaine like :k ORDER BY m.nomclub ASC ")
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
        $e = "valider";
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.nomclub','COUNT(p.idclub) x','u.nomclub as nomclub','u.idclub as idclub','u.image  as image','u.domaine as domaine')
            ->from(' EvenementBundle:Evenement', 'p')
            ->innerJoin('EvenementBundle:Club', 'u', 'where', 'u.idclub = :ii')

            ->where('p.idclub = :ii')


            ->setParameter('ii',$o);


        return $qb->getQuery()->getResult();

    }
    public function ClubUser(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idclub','c.nomclub')
            ->distinct('c.idclub')
            ->from(' EvenementBundle:Club', 'c')
            ->innerJoin('schoolBundle:Users', 'p', 'where', 'p.id =c.idresponsable');


        return $qb->getQuery()->getResult();

    }
    public function ClubRate($x){

            $qb = $this->_em->createQueryBuilder();
            $qb->select('p.idclub','Avg(r.rating)  rating','p.nomclub','p.domaine','p.image','m.username','m.id','m.email')
                ->from(' EvenementBundle:Rate', 'r')
                ->innerJoin('EvenementBundle:Club', 'p', 'where', 'p.idclub =:ii')
                ->innerJoin('schoolBundle:Users', 'm', 'where', 'm.id =p.idresponsable')

        ->where('r.idc = :ii')
                ->setParameter('ii',$x);
        return $qb->getQuery()->getResult();
    }
    public function responsableclub($x){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idclub','c.nomclub')
            ->distinct('c.idclub')
            ->from(' EvenementBundle:Club', 'c')
            ->innerJoin('schoolBundle:Users', 'p', 'where', 'p.id =:ii')
            ->where('c.idresponsable=:ii')
        ->setParameter('ii',$x);
        return $qb->getQuery()->getResult();

    }
    public  function testt($e,$u)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p,u')
            ->from(' EvenementBundle:Rate', 'p')
            ->innerJoin('EvenementBundle:Club', 'c', 'where', 'c.idclub =:ee')
            ->innerJoin('schoolBundle:Users', 'u', 'where', 'u.id =:uu')

            ->where('p.idc=:ee')
            ->andWhere('p.iduser=:uu')
            ->setParameter('ee',$e)
            ->setParameter('uu',$u)



        ;


        return $qb->getQuery()->getResult();
    }

    /*books*/

    public function searchBook($var){
        $qry=$this->getEntityManager()
            ->createQuery("SELECT m FROM BooksBundle:Books m where m.titrebook like :titre  ORDER BY m.titrebook ASC ")
            ->setParameter('titre','%'.$var.'%');
        return $qry->getResult();
    }
}