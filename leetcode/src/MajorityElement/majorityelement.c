//Given an array of size n, find the majority element. The majority element is the element that appears more than ? n/2 ? times.

//You may assume that the array is non-empty and the majority element always exist in the array.

int majorityElement(int* nums, int numsSize)
{
	int count = 1, element = nums[0], i = 0;
	for (i = 1; i < numsSize; ++i)
	{
		if (nums[i] == element)
		{
			++count;
		}
		else
		{
			--count;
		}
		if (count == 0)
		{
			count = 1;
			element = nums[i];
		}
	}
	return element;
}