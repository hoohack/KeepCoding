package com.base;

import com.base.Beverage;

/**
 * Created by hhq on 1/8/15.
 */
public class HouseBlend extends Beverage {
    public HouseBlend() {
        description = "House Blend Coffee";
    }
    
    public double cost() {
        return 0.89;
    }
}
