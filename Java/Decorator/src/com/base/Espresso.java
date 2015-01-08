package com.base;

import com.base.Beverage;

/**
 * Created by hhq on 1/8/15.
 */
public class Espresso extends Beverage {
    public Espresso() {
        description = "Espresso";
    }
    
    public double cost() {
        return 1.99;
    }
}
