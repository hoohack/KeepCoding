#include "queue.h"
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>

static inline void check_queue_malloc(Queue *q)
{
	if (q == NULL) {
		fprintf(stderr, "malloc queue failed\n");
		exit(EXIT_FAILURE);
	}
}

static inline void check_node_malloc(QueueNode *node)
{
	if (node == NULL) {
		fprintf(stderr, "malloc queue node failed\n");
		exit(EXIT_FAILURE);
	}
}

/**
 * 创建队列
 */
QUEUE_API Queue *create_queue()
{
	Queue *q = (Queue *)malloc(INIT_SIZE * sizeof(Queue));
	check_queue_malloc(q);

	q->head = NULL;
	q->tail = NULL;
	q->capacity = INIT_SIZE;
	q->length = 0;

	return q;
}

/**
 * 进队列
 */
QUEUE_API int en_queue(Queue *q, void *value)
{
	if (is_full(q))
		return FAILED;
	QueueNode *new_node = (QueueNode *)malloc(sizeof(QueueNode));
	check_node_malloc(new_node);

	new_node->value = value;
	if (q->head == NULL) {
		q->head = new_node;
		q->tail = new_node;
	} else {
		q->tail->next = new_node;
		q->tail = new_node;
	}

	q->tail->next = NULL;
	++q->length;

	return SUCCESS;
}

/**
 * 出队列
 */
QUEUE_API void *de_queue(Queue *q)
{
	if (is_empty(q))
		return FAILED;

	QueueNode *current = q->head;
	void *de_value = current->value;
	q->head = q->head->next;
	--q->length;

	free(current);

	return de_value;
}

/**
 * 返回队首元素
 */
QUEUE_API void *first(const Queue *q)
{
	if (is_empty(q))
		return NULL;

	return q->head->value;
}

/**
 * 判断队列是否为空
 */
QUEUE_API bool is_empty(const Queue *q) { return q->head == NULL; }

/**
 * 判断队列是否已满
 */
QUEUE_API bool is_full(const Queue *q) { return q->length == q->capacity; }
