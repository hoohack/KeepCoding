#include "common.h"

void print_stack(const Stack *s)
{
	if (s == NULL) {
		printf("stack is null\n");
		exit(EXIT_FAILURE);
	}
	StackNode *current = s->top;
	while (current != NULL) {
		printf("%d ", *((int *)current->value));
		current = current->next;
	}

	printf("\n");
}
