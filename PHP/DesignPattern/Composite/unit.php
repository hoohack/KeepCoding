<?php
/**
 * User: hhq
 * Date: 12/27/14
 */
include_once 'UnitException.php';
abstract class Unit {
    public function getComposite() {
        return null;
    }

    public abstract function bombardStrength();
}