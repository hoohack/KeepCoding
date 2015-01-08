import com.base.Beverage;
import com.base.CondimentDecorator;

/**
 * Created by hhq on 1/8/15.
 */
public class Mocha extends CondimentDecorator {
    Beverage beverage;
    
    public Mocha(Beverage beverage) {
        this.beverage = beverage;
    }

    @Override
    public String getDescription() {
        return beverage.getDescription() + ", Mocha";
    }
    
    public double cost() {
        return 0.20 + beverage.cost();
    }
}
