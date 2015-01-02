package com.strategy;

/**
 * Created by hhq on 1/2/15.
 */
public class MuteQuack implements QuackBehaviour {
    public void quack() {
        System.out.println("<< Silence >>");
    }
}
