package com.base;

import com.base.Pizza;

/**
 * Created by hhq on 1/14/15.
 */
public abstract class PizzaStore {
    public Pizza orderPizza(String type) {
        Pizza pizza;
        
        pizza = createPizza(type);
        
        pizza.prepare();
        pizza.bake();
        pizza.cut();
        pizza.box();
        return pizza;
    }
    
    protected abstract Pizza createPizza(String type);
}
