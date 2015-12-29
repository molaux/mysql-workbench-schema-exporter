<?php

//     case 'test-insert':
        
$output->writeln(
    sprintf(
        "<info>Starting database insertions</info>"
    )
);

$precise = new TestEntity\Skill();
$precise->setName("precise");
$em->persist($precise);

$resourceful = new TestEntity\Skill();
$resourceful->setName("resourceful");
$em->persist($resourceful);

$persistent = new TestEntity\Skill();
$persistent->setName("persistent");
$em->persist($persistent);

$human = new TestEntity\Skill();
$human->setName("a human");
$em->persist($human);

$place1 = new TestEntity\Place();
$place1->setName("Alès");
$em->persist($place1);

$place2 = new TestEntity\Place();
$place2->setName("Timbuktu");
$em->persist($place2);

$tool = new TestEntity\Tool();
$tool->setName("General Tool");
$em->persist($tool);

$violon1 = new TestEntity\Violon();
$violon1->setName("Stradivarius");
$em->persist($violon1);

$violon2 = new TestEntity\Violon();
$violon2->setName("Acousta Grip");
$em->persist($violon2);

$hammer = new TestEntity\Hammer();
$hammer->setName("Revex");
$em->persist($hammer);

$pen1 = new TestEntity\Pen();
$pen1->setName("Mont-Blanc");

$pen3 = clone $pen1;

$em->persist($pen1);

$em->persist($pen3);

$pen2 = new TestEntity\Pen();
$pen2->setName("Bic");
$em->persist($pen2);

$bistoury = new TestEntity\Bistoury();
$bistoury->setName("RS");
$em->persist($bistoury);

$person = new TestEntity\Person();
$person->setName("Anonymous");
$person->addTool($tool);
$tool->setPerson($person);
$person->setPlace($place1);
$em->persist($person);

$violonist = new TestEntity\Violonist();
$violonist->setName("Samvel Yervinyan");
$em->persist($violonist);
$violonist->AddViolon($violon1);
$violon1->setPerson($violonist);
$violonist->AddViolon($violon2);
$violon2->setPerson($violonist);
$violonist->AddTool($pen3);
$pen3->setPerson($violonist);
$violonist->addSkill($persistent);
$violonist->addSkill($precise);
$violonist->addSkill($human);
$violonist->setPlace($place1);

$surgeon = new TestEntity\Surgeon();
$surgeon->setName("Dr Romain Bidar");
$em->persist($surgeon);
$surgeon->AddTool($pen1);
$pen1->setPerson($surgeon);
$surgeon->AddTool($bistoury);
$bistoury->setPerson($surgeon);
$surgeon->addSkill($human);
$surgeon->addSkill($precise);
$surgeon->setPlace($place2);

$plumber = new TestEntity\Plumber();
$plumber->setName("Marcel Durand");
$em->persist($plumber);
$plumber->AddTool($pen2);
$pen2->setPerson($plumber);
$plumber->AddTool($hammer);
$hammer->setPerson($plumber);
$plumber->addSkill($resourceful);
$plumber->setPlace($place2);

$em->flush();

// case 'test-retrieve':

$persons = $em->getRepository('ArmadaManagerBundle:Test\Person')->findAll();
echo "\nList of persons :\n";
foreach ($persons as $person) {
    echo sprintf("\n  + %s lives in %s and has the following tools and skills :\n", 
        $person,
        $person->getPlace()
    );
    echo "    # Tools :\n";
    foreach($person->getTools() as $tool) {
        echo sprintf("      - $tool (%s)\n", $tool->getPerson());
    }
    if ($person instanceof TestEntity\Violonist) {
        $count = $person->getViolons()->count();
        echo sprintf("    # This person is a violonist and has %s\n", $count == 0 ? "no violon." : "$count violon(s) :");
        foreach ($person->getViolons() as $violon) {
            echo "      - $violon\n";
        }
    }
    echo "    # Skills :\n";
    foreach($person->getSkills() as $skill) {
        echo "      - he has to be $skill\n";
    }
}

$violons = $em->getRepository('ArmadaManagerBundle:Test\Violon')->findAll();
echo "\nList of violons :\n\n";
foreach ($violons as $violon) {
    echo sprintf("  - $violon : %s\n", $violon->getViolonist());
}
echo "\n";





// List of persons :
// 
//   + Person Anonymous (14) lives in [Place] Alès (9) and has the following tools and skills :
//     # Tools :
//       - Tool General Tool (4) (Person Anonymous (14))
//     # Skills :
// 
//   + Violonist Samvel Yervinyan (15) lives in [Place] Alès (9) and has the following tools and skills :
//     # Tools :
//       - Pen Mont-Blanc (9) (Violonist Samvel Yervinyan (15))
//       - Violon Acousta Grip (6) (Violonist Samvel Yervinyan (15))
//       - Violon Stradivarius (5) (Violonist Samvel Yervinyan (15))
//     # This person is a violonist and has 2 violon(s) :
//       - Violon Acousta Grip (6)
//       - Violon Stradivarius (5)
//     # Skills :
//       - he has to be [Skill] precise (1)
//       - he has to be [Skill] persistent (3)
//       - he has to be [Skill] a human (4)
// 
//   + Surgeon Dr Romain Bidar (16) lives in [Place] Timbuktu (10) and has the following tools and skills :
//     # Tools :
//       - Bistoury RS (11) (Surgeon Dr Romain Bidar (16))
//       - Pen Mont-Blanc (8) (Surgeon Dr Romain Bidar (16))
//     # Skills :
//       - he has to be [Skill] precise (1)
//       - he has to be [Skill] a human (4)
// 
//   + Plumber Marcel Durand (17) lives in [Place] Timbuktu (10) and has the following tools and skills :
//     # Tools :
//       - Pen Bic (10) (Plumber Marcel Durand (17))
//       - Hammer Revex (7) (Plumber Marcel Durand (17))
//     # Skills :
//       - he has to be [Skill] resourceful (2)
// 
// List of violons :
// 
//   - Violon Stradivarius (5) : Violonist Samvel Yervinyan (15)
//   - Violon Acousta Grip (6) : Violonist Samvel Yervinyan (15)