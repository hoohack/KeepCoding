#include "stack.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

static void check_stack_not_null(Stack *s)
{
	if (s == NULL) {
		fprintf(stderr, "malloc stack failed\n");
		exit(EXIT_FAILURE);
	}
}

static void check_node_not_null(StackNode *node)
{
	if (node == NULL) {
		fprintf(stderr, "malloc stack node failed\n");
		exit(EXIT_FAILURE);
	}
}

/**
 * 初始化栈
 */
STACK_API Stack *create_stack()
{
	Stack *new_stack = (Stack *)malloc(INIT_SIZE * sizeof(Stack));
	check_stack_not_null(new_stack);

	memset(new_stack, 0, sizeof(Stack));
	new_stack->top = NULL;
	new_stack->size = INIT_SIZE;
	new_stack->curr_size = 0;

	return new_stack;
}

/**
 * 将value压栈
 */
STACK_API int push(Stack *s, void *value)
{
	if (is_full(s))
		return FAILED;

	StackNode *new_node = (StackNode *)malloc(sizeof(StackNode));
	check_node_not_null(new_node);

	new_node->value = value;
	if (s->top == NULL)
		new_node->next = NULL;
	else
		new_node->next = s->top;

	s->top = new_node;
	++s->curr_size;

	return SUCCESS;
}

/**
 * 从栈顶弹出一个元素
 */
STACK_API void *pop(Stack *s)
{
	check_stack_not_null(s);
	if (is_empty(s))
		return FAILED;

	StackNode *current = s->top;
	void *pop_value = current->value;
	s->top = s->top->next;
	--s->curr_size;
	free(current);

	return pop_value;
}

/**
 * 返回栈顶元素
 */
STACK_API StackNode *top(const Stack *s)
{
	if (is_empty(s))
		return NULL;

	return s->top->value;
}

/**
 * 判断栈是否为空
 */
STACK_API bool is_empty(const Stack *s) { return s->top == NULL; }

/**
 * 判断栈是否已满
 */
STACK_API bool is_full(const Stack *s) { return s->size == s->curr_size; }

/**
 * 销毁栈
 */
STACK_API void destroy_stack(Stack **s_ref)
{
	void *pop_value = NULL;
	Stack *s = *s_ref;
	while (!is_empty(s)) {
		pop_value = pop(s);
	}

	*s_ref = NULL;
}
