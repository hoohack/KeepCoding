<?php
/**
 * @Author: huhuaquan
 * @Date:   2015-07-28 16:43:12
 * @Last Modified by:   huhuaquan
 * @Last Modified time: 2015-07-28 17:17:23
 */
class MyStack {

	protected $stack;
	protected $max_num;

	public function __construct($max_num = 10)
	{
		$this->stack = array();
		$this->max_num = $max_num;
	}

	/**
	 * [pop 弹出栈元素]
	 * @return [mixed] [栈顶元素]
	 */
	public function pop()
	{
		if ($this->isEmpty())
		{
			throw new RunTimeException('Stack is empty!');
		}
		else
		{
			return array_shift($this->stack);
		}
	}

	/**
	 * [push 元素入栈]
	 * @param  [mixed] $item [需要入栈的元素]
	 * @return [mixed]       [成功入栈的元素]
	 */
	public function push($item)
	{
		if (count($this->stack) >= $this->max_num)
		{
			throw new RunTimeException("Stack is full");
		}
		else
		{
			array_unshift($this->stack, $item);
			return $item;
		}
	}

	/**
	 * [top 返回栈顶元素]
	 * @return [mixed] [栈顶元素]
	 */
	public function top()
	{
		if (!$this->isEmpty())
		{
			return current($this->stack);
		}
		else
		{
			throw new RunTimeException('Stack is empty');
		}
	}

	/**
	 * [isEmpty 判断栈是否为空]
	 * @return boolean
	 */
	public function isEmpty()
	{
		return empty($this->stack);
	}

}