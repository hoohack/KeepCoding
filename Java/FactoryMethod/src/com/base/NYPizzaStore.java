package com.base;

import com.base.Pizza;
import com.base.PizzaStore;

/**
 * Created by hhq on 1/14/15.
 */
public class NYPizzaStore extends PizzaStore {
    protected Pizza createPizza(String item) {
        if (item.equals("cheese")) {
            return new NYStyleCheesePizza();
        } else if (item.equals("veggie")) {
            return new NYStyleVeggiePizza();
        } else if (item.equals("clam")) {
            return new NYStyleClamPizza();
        } else if (item.equals("pepperoni")) {
            return new NYStylePepperoni();
        } else 
            return null;
    }
}
