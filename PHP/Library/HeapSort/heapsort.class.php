<?php
	//HeapSort class
	/**
	* 堆排
	* @author hhq
	*/
	class HeapSort {

		//进行排序
		public static function Sort(&$list) {
			$list_len = count($list);

			//检查数组合法性
			if (count($list) == 0) {
				trigger_error('请输入正确的数组', E_USER_ERROR);
			}

			//构建一个大顶堆
			for ($i = intval($list_len/2); $i >= 0; $i--) {
				self::HeapAdjust($list, $i, $list_len - 1);
			}

			//逐步调整大顶堆，从而进行排序
			for ($i = $list_len - 1; $i > 0; $i--) {
				//将堆顶记录与当前未经排序子序列的最后一个记录交换
				self::Swap($list, 0, $i);

				//将$list[0...i-1]重新调整成大顶堆
				self::HeapAdjust($list, 0, $i - 1);
			}
		}

		//调整序列称为一个大顶堆
		protected static function HeapAdjust(&$list, $low, $high) {
			$temp = $list[$low];


			for ($i= 2 * $low; $i <= $high; $i *= 2) {
				//沿关键字较大的孩子节点向下筛选
				if ($i < $high && ($list[$i] < $list[$i + 1])) {
					++$i;//i为关键字较大的记录的下标
				}

				//如果比孩子节点大，则不必交换
				if ($temp >= $list[$i]) {
					break;
				}
				$list[$low] = $list[$i];
				$low = $i;
			}

			//插入较大的节点值
			$list[$low] = $temp;
		}

		//交换两个元素
		protected static function Swap(&$list, $a, $b) {
			$temp = $list[$a];
			$list[$a] = $list[$b];
			$list[$b] = $temp;
		}
	}