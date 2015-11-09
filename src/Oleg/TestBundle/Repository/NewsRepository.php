<?php

namespace Oleg\TestBundle\Repository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNewsByslug($slug)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->andWhere('n.slug = :slug')
                ->setParameter(':slug', $slug);

        return $qb->getQuery()->getResult();
    }
}
