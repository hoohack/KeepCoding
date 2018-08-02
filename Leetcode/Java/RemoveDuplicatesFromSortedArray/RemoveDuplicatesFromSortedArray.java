import java.util.Arrays;

public class RemoveDuplicatesFromSortedArray {
    public int removeDuplicates(int[] nums) {
        int cursor = 0, result = 0, arrLen = nums.length;
        if (arrLen == 0) {
            return 0;
        }

        cursor = nums[0];
        result++;
        for (int i = 1; i < arrLen; i++) {
            if (cursor == nums[i]) {
                continue;
            } else {
                result++;
                cursor = nums[i];
                nums[result-1] = nums[i];
            }
        }

        return result;
    }

    public static void main(String args[]) {
        RemoveDuplicatesFromSortedArray s = new RemoveDuplicatesFromSortedArray();

        int[] nums1 = new int[]{1,1,2};
        int result1 = s.removeDuplicates(nums1);
        System.out.println(Arrays.toString(nums1));
        System.out.println(result1);

        int[] nums2 = new int[]{0,0,1,1,1,2,2,3,3,4};
        int result2 = s.removeDuplicates(nums2);
        System.out.println(Arrays.toString(nums2));
        System.out.println(result2);
    }
}
