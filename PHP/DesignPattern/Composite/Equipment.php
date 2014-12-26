<?php
/**
 * User: hector
 * Date: 12/26/14
 */
class Equipment {
    private $name;

    public function getName() { return $this->name; }

    protected function power() {}

    protected function netPrice() {}

    protected function discountPrice() {}

    protected function add(Equipment $equipment) {}

    protected function remove(Equipment $equipment) {}

}