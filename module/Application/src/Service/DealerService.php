<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:43
 */

namespace Application\Service;

use Application\Entity\Dealer;
use Doctrine\ORM\EntityManager;

class DealerService
{

    /**
     * @var EntityManager $entitymanager
     */
    private $entitymanager;

    /**
     * FeedService constructor.
     * @param EntityManager $entitymanager
     */
    public function __construct(EntityManager $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }


    public function saveDealer($dealer)
    {
        $dealer = $this->getEntityManager()->getRepository('Application\Entity\Dealer')->findOneBy(array('id' => $dealer->id));
        if (!$dealer) {
            $dealer = new Dealer();
            $this->getEntityManager()->persist($dealer);
        }

        $this->getEntityManager()->flush();
    }

    public function deleteDealer($id)
    {
        $dealer = $this->entitymanager->find('Application\Entity\Dealer', $id);
        $this->entitymanager->remove($dealer);
        $this->entitymanager->flush();
    }

    public function getDealer($id)
    {
        return $this->entitymanager->getRepository('Application\Entity\Dealer')->findOneBy(['id' => $id]);
    }

    public function findAllDealers()
    {
        return $this->entitymanager->getRepository('Application\Entity\Dealer')->findAll();
    }
}