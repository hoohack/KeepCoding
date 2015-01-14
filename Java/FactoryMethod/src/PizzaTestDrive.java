import com.base.ChicagoPizzaStore;
import com.base.NYPizzaStore;
import com.base.Pizza;
import com.base.PizzaStore;

/**
 * Created by hhq on 1/14/15.
 */
public class PizzaTestDrive {
    public static void main(String args[]) {
        PizzaStore nyStore = new NYPizzaStore();
        PizzaStore chicagoStore = new ChicagoPizzaStore();
        
        Pizza pizza = nyStore.orderPizza("cheese");
        System.out.println("Ethan ordered a " + pizza.getName() + "\n");
        
        pizza = chicagoStore.orderPizza("cheese");
        System.out.println("Joel ordered a " + pizza.getName() + "\n");
    }
}
