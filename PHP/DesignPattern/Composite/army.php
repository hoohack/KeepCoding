<?php
/**
 * User: hhq
 * Date: 12/27/14
 */
include_once 'compositeUnit.php';
class Army extends CompositeUnit {

    public function bombardStrength() {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}