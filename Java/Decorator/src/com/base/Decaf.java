package com.base;

import com.base.Beverage;

/**
 * Created by hhq on 1/8/15.
 */
public class Decaf extends Beverage {
    public Decaf() {
        description = "com.base.Decaf";
    }
    
    public double cost() {
        return 0.99;
    }
}
