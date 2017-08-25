<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
	public function findAllJoinedToTags()
	{
		$query = $this->getEntityManager()
			->createQuery(
				'SELECT t, g FROM AppBundle:Task t JOIN t.tags g'
			);

		try {
			return $query->getResult();
		} catch (\Doctrine\ORM\NoResultException $e) {
			return null;
		}
	}

	public function findOneByIdJoinedToTags($id)
	{
		$query = $this->getEntityManager()
			->createQuery(
				'SELECT t, g FROM AppBundle:Task t JOIN t.tags g WHERE t.id = :id'
				)->setParameter('id', $id);

		try {
			return $query->getResult();
		} catch (\Doctrine\ORM\NoResultException $e) {
			return null;
		}
	}
}
