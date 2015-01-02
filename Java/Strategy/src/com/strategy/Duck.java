package com.strategy;

/**
 * Created by hhq on 1/2/15.
 */
public abstract class Duck {
    FlyBehaviour flyBehaviour;
    QuackBehaviour quackBehaviour;

    public Duck() {

    }

    public abstract void display();

    public void setFlyBehaviour(FlyBehaviour fb) {
        flyBehaviour = fb;
    }

    public void setQuackBehaviour(QuackBehaviour qb) {
        quackBehaviour = qb;
    }

    public void performFly() {
        flyBehaviour.fly();
    }

    public void performQuack() {
        quackBehaviour.quack();
    }

    public void swim() {
        System.out.println("All ducks float, even decoys!");
    }
}
