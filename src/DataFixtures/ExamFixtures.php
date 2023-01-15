<?php

namespace App\DataFixtures;

use App\Entity\Exam;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach(range(1,10) as $i) {
            $exam = new Exam();
            $exam->setName('exam_' . $i);
            $exam->setCreateDt(new \DateTime());
            $exam->setDescription('description_' . $i);
            $manager->persist($exam);
        }
        $manager->flush();
    }
}
