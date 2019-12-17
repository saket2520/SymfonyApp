<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
/**
 * @return Object[]
 */
    
    public function findAllByType($value) 
    {
   /* $con=$this->getEntityManager()->getConnection();
    $sql="Select type,count(type) as Number_of_Products From product Group by type Having type='Elec&Mech'
    ";
    $stmt=$con->prepare($sql);
    $stmt->execute(['type'=>$value]);
    return $stmt->fetchAll();    

    $entitymanager=$this->getEntityManager();
    $query=$entitymanager->createQuery('Select p from App\Entity\Product p Where p.Type =:value')->setParameter('value',$value);
 return $query->getResult();
*/

}


    public function finddocBy()
    {// $query=$this->getEntityManager()->createQuery("Select partial p.{id,product_id,name,owner_name} From App\Entity\Product p");
    $query=$this->getEntityManager()->createQuery("Select p from App\Entity\Product p");
    return $query->getResult();





       /* return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        */
    }
}

