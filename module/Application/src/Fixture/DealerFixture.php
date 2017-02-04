<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 03-02-17
 * Time: 21:11
 */

namespace Application\Fixture;


use Application\Entity\Dealer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DealerFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Dealer $dealer */
        $dealer = new Dealer();
        $dealer->setName('Renault');
        $dealer->setCity('Rotterdam');

        $manager->persist($dealer);
        $manager->flush();
    }
}