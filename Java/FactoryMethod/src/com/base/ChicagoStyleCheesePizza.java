package com.base;

import com.base.Pizza;

/**
 * Created by hhq on 1/14/15.
 */
public class ChicagoStyleCheesePizza extends Pizza {
    public ChicagoStyleCheesePizza() {
        name = "Chicago Style Sauce and Cheese com.base.Pizza";
        dough = "Extra Thick crust Dough";
        sauce = "Plum Tomato Sauce";

        toppings.add("Shredded Mozzarella Cheese");
    }
    
    void cut() {
        System.out.println("Cutting the pizza into square slices");
    }
}
