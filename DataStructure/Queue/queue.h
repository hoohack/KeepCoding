#ifndef _QUEUE_H
#define _QUEUE_H

#include <stdbool.h>

#define SUCCESS 1
#define FAILED 0
#define INIT_SIZE 20
#define QUEUE_API

typedef struct _queue_node
{
	void* value;
	struct _queue_node* next;
} QueueNode;

typedef struct _queue
{
	QueueNode* head;
	QueueNode* tail;
	int capacity;
	int length;
} Queue;

QUEUE_API Queue* create_queue();
QUEUE_API int en_queue(Queue* q, void* value);
QUEUE_API void* de_queue(Queue* q);
QUEUE_API void* first(const Queue* q);
QUEUE_API bool is_empty(const Queue* q);
QUEUE_API bool is_full(const Queue* q);

#endif
