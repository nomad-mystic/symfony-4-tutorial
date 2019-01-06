<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/25/18
 * Time: 1:24 PM
 */

namespace App\DataFixtures;


use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{
		for ($i =0; $i < 10; $i++) {
			$microPost = new MicroPost();
			$microPost->setText('Some random Text ' . rand(0, 100));
			$microPost->setTime(new \DateTime('2018-03-15'));
			$manager->persist($microPost);
		}

		$manager->flush();
	}
}