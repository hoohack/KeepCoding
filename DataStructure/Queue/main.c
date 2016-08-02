#include "common.h"
#include "queue.h"
#include <stdlib.h>

int main()
{
	Queue *q = create_queue();
	int *data = malloc(sizeof(int));
	*data = 1;
	int *data2 = malloc(sizeof(int));
	en_queue(q, data);
	int *data3 = malloc(sizeof(int));
	*data3 = 3;
	en_queue(q, data3);

	*data2 = 2;
	en_queue(q, data2);
	printf("current first value %d\n", *((int *)first(q)));
	print_queue(q);
	de_queue(q);
	print_queue(q);
	printf("current first value %d\n", *((int *)first(q)));
	print_queue(q);

	return 0;
}
