import com.strategy.Duck;
import com.strategy.FlyRocketPowered;
import com.strategy.MallardDuck;
import com.strategy.ModelDuck;

/**
 * Created by hhq on 1/2/15.
 */
public class MiniDuckSimulator {
    public static void main(String[] args) {
        Duck mallard = new MallardDuck();
        mallard.performQuack();
        mallard.performFly();
        Duck model = new ModelDuck();
        model.performFly();
        model.setFlyBehaviour(new FlyRocketPowered());
        model.performFly();
    }
}
