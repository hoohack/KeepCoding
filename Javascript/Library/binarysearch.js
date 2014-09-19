//二分查找
function BinarySearch(val, arr) {
    var len = arr.length,
        low = 0,
        high = len - 1,
        mid = 0;
        
    if (val < arr[low] || val > arr[high]) {
        return -1;
    }
    
    while (low <= high) {
        mid = Math.floor((low + high) / 2);

        if (arr[mid] == val) {
            return mid;
        } else if(arr[mid] > val) {
            high = mid - 1;
        } else {
            low = mid + 1;
        }
    }

    return -1;
}

// var test_arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
// console.log(BinarySearch(4, test_arr));
