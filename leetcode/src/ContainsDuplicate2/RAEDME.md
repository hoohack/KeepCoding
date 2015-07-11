// Given an array of integers and an integer k, find out whether there there are two distinct indices 
// i and j in the array such that nums[i] = nums[j] and the difference between i and j is at most k.

题目的意思是给定一个整型数组和一个整数k，找出在i到j之间是否有两个相等的书且i与j之间的距离最大不大于k。

本题的解法的使用集合的数据结构，维护一个只有k个元素的滑动窗口集合。每次在集合里新增一个序列里的元素，如果集合的元素数量小于k且有相等的元素，则返回true。否则，如果集合的元素数量大于k，则将集合中最左边的元素移除后继续。