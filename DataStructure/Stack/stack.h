#ifndef _STACK_H
#define _STACK_H

#include <stdbool.h>

#define FALSE 0
#define TRUE 1
#define SUCCESS 1
#define FAILED 0
#define INIT_SIZE 20
#define STACK_API

typedef struct _stack_node
{
	void* value;
	struct _stack_node* next;
} StackNode;

typedef struct _stack
{
	StackNode* top;
	int size;
	int curr_size;
} Stack;

STACK_API Stack* create_stack();
STACK_API void destroy_stack(Stack** s_ref);
STACK_API int push(Stack* s, void* value);
STACK_API void* pop(Stack* s);
STACK_API StackNode* top(const Stack* s);
STACK_API bool is_empty(const Stack* s);
STACK_API bool is_full(const Stack* s);

#endif
