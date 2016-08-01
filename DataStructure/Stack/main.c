#include "stack.h"
#include "common.h"
#include <stdlib.h>
#include <stdio.h>

int main()
{
	Stack *s = create_stack();

	int *data = malloc(sizeof(int));
	*data = 1;
	int *data2 = malloc(sizeof(int));
	push(s, data);
	*data2 = 2;
	push(s, data2);
	printf("cur top %d\n", *((int *)top(s)));
	destroy_stack(&s);
	print_stack(s);
	pop(s);
	print_stack(s);
	pop(s);

	return 0;
}
