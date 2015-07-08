Given an array of integers, find if the array contains any duplicates. Your function should return true if any value appears at least twice in the array, and it should return false if every element is distinct.

刚开始用了蛮解，直接两个循环判断，提交的时候超时了，果然不能一来就蛮力解，算法还是很重要的。

先将数据排序，然后判断相邻的元素是否有相同的，如果有相同的则说明有重复的元素。