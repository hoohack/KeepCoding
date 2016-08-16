#include "common.h"
#include <stdio.h>

void print_node(const void* value)
{
	printf("%d\n", *((int*)value));
}
