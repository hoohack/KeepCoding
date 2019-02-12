import java.util.ArrayList;
import java.util.Arrays;
import java.util.LinkedList;
import java.util.List;
import java.util.stream.Collectors;

class Solution {
    public List<Integer> addToArrayForm(int[] A, int K) {
        List<Integer> la = Arrays.stream(A)
                .boxed()
                .collect(Collectors.toList());

        List<Integer> l = new ArrayList<>();
        while (K != 0) {
            l.add(0, K % 10);
            K /= 10;
        }

        int more = 0;
        LinkedList<Integer> ret = new LinkedList<>();
        int tmpSum;
        int i = 0;
        for (; i < la.size() || i < l.size(); i++) {
            if (i < la.size() && i < l.size()) {
                tmpSum = la.get(la.size() - 1 - i) + l.get(l.size() - 1 - i) + more;
            } else if (la.size() > l.size()) {
                tmpSum = la.get(la.size() - 1 - i) + more;
            } else {
                tmpSum = l.get(l.size() - 1 - i) + more;
            }

            if (tmpSum >= 10) {
                more = 1;
                tmpSum = tmpSum % 10;
            } else {
                more = 0;
            }

            ret.add(0, tmpSum);
        }

        if (more == 1) {
            ret.add(0, more);
        }

        return ret;
    }

    public static void main(String[] args) {
        Solution s = new Solution();
        int[] A = new int[]{9,9,9,9,9,9,9,9,9,9};
        List<Integer> l = s.addToArrayForm(A, 1);

        System.out.println(l);

    }
}