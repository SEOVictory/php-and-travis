<?php

// TODO: create bootstrap with outloader
include './src/lib/MapTrap.php';

class MapTrapTest extends \PHPUnit_Framework_TestCase
{
  public function testMissTrap()
  {
    $mt = new MapTrap();
    $mt->setCallback(function ($vv) {
        return $vv + 1;
    });
    $ar = array(0, 0, 0, 0, 0);
    $expected = array(1, 1, 1, 1, 1);
    $actual = $mt($ar, 5);
    $this->assertEquals($expected, $actual);
  }
}