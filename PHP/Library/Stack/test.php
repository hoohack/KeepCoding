<?php
/**
 * @Author: huhuaquan
 * @Date:   2015-07-28 17:01:36
 * @Last Modified by:   huhuaquan
 * @Last Modified time: 2015-07-28 17:17:12
 */
	require_once './stack.php';

	$stack = new MyStack();

	if ($stack->isEmpty())
	{
		echo "empty";
	}

	$stack->push(1);
	$stack->push(2);
	$stack->push(3);
	$stack->push(4);
	$stack->push(5);
	$stack->push(6);
	$stack->push(7);
	$stack->push(8);
	$stack->push(9);
	$stack->push(10);
	// $stack->push(1);
	echo $stack->top();

	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();
	$stack->pop();

	// echo $stack->top();