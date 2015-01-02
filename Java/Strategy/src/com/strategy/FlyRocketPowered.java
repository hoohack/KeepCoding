package com.strategy;

/**
 * Created by hhq on 1/2/15.
 */
public class FlyRocketPowered implements FlyBehaviour {
    @Override
    public void fly() {
        System.out.println("I'm flying with a rocket");
    }
}
