import com.base.Beverage;
import com.base.CondimentDecorator;

/**
 * Created by hhq on 1/8/15.
 */
public class Soy extends CondimentDecorator {
    Beverage beverage;

    public Soy(Beverage beverage) {
        this.beverage = beverage;
    }

    @Override
    public String getDescription() {
        return beverage.getDescription() + ", Soy";
    }

    public double cost() {
        return 0.21 + beverage.cost();
    }
}