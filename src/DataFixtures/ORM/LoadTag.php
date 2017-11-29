<?php

namespace App\DataFixtures\ORM;

use App\Entity\Tag;
use App\Entity\User;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTag extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        $tag = new Tag("Wow", $this->container->get(SlugGenerator::class)->generate("Wow"));
        $tag1 = new Tag("Wew", $this->container->get(SlugGenerator::class)->generate("Wew"));
        $tag2 = new Tag("Wiw", $this->container->get(SlugGenerator::class)->generate("Wiw"));


        $manager->persist($tag);
        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->flush();
    }
}
