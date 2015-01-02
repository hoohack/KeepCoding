package com.strategy;

/**
 * Created by hhq on 1/2/15.
 */
public class ModelDuck extends Duck {
    public ModelDuck() {
        flyBehaviour = new FlyNoWay();
        quackBehaviour = new Quack();
    }

    public void display() {
        System.out.println("I'm a model duck");
    }
}
