<?php
/**
 * User: hhq
 * Date: 12/27/14
 */
include_once 'army.php';
include_once 'archer.php';
include_once 'laserCannon.php';
$main_army = new Army();

$main_army->addUnit(new Archer());
$main_army->addUnit(new LaserCannon());

$sub_army = new Army();

$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());

$main_army->addUnit($sub_army);

print "attacking with strength {$main_army->bombardStrength()} \n";