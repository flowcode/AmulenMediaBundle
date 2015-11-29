<?php

namespace Flowcode\MediaBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GalleryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GalleryRepository extends EntityRepository {

    public function getQuerySearch($search_str = null, $type = null) {
        $query = $this->createQueryBuilder("g");

        /* search */
        if (!is_null($search_str)) {
            $query->andWhere("g.name LIKE :search");
            $query->setParameter("search", "%$search_str%");
        }

        /* category */
        if (!is_null($type) && !empty($type)) {
            $query->andWhere("g.type = :type");
            $query->setParameter("type", $type);
        }

        return $query;
    }

}