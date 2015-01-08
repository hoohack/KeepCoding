import com.base.Beverage;
import com.base.CondimentDecorator;

/**
 * Created by hhq on 1/8/15.
 */
public class Whip extends CondimentDecorator {
    Beverage beverage;

    public Whip(Beverage beverage) {
        this.beverage = beverage;
    }

    @Override
    public String getDescription() {
        return beverage.getDescription() + ", Whip";
    }

    public double cost() {
        return 0.30 + beverage.cost();
    }
}