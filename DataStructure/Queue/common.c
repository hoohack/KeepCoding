#include "common.h"

void print_queue(const Queue *q)
{
	QueueNode *current = q->head;
	while (current != NULL) {
		printf("%d ", *((int *)current->value));
		current = current->next;
	}

	printf("\n");
}
