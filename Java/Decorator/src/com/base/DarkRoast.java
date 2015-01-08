package com.base;

import com.base.Beverage;

/**
 * Created by hhq on 1/8/15.
 */
public class DarkRoast extends Beverage {
    public DarkRoast() {
        description = "Dark Roast";
    }
    
    public double cost() {
        return 0.99;
    }
}
