#include "hash.h"
#include <stdlib.h>
#include <string.h>
#include <stdio.h>

HASH_API hash_init(Hashtable *ht, hash_func hashFunction, destruct pDestructor)
{
	Bucket **tmp;
	uint i = 3;

	if (DEFAULT_SIZE >= 0x80000000) {
		ht->nTableSize = 0x80000000;
	} else {
		while ((1U << i) < DEFAULT_SIZE) {
			++i;
		}
		ht->nTableSize = 1 << i;
	}

	ht->nTableMask = ht->nTableSize - 1;
	ht->hBuckets = NULL;
	ht->nNumOfElements = 0;
	ht->hashFunction = hashFunction;
	ht->pDestructor = pDestructor;
	ht->pListHead = NULL;
	ht->pListTail = NULL;

	tmp = (Bucket **)malloc(ht->nTableSize * sizeof(Bucket *));
	if (!tmp) {
		return FAILURE;
	}
	ht->hBuckets = tmp;
	return SUCCESS;
}

uint hash_table_size(Hashtable *ht) { return ht->nTableSize; }

uint hash_table_nums(Hashtable *ht) { return ht->nNumOfElements; }

void _update_data(Bucket *p, void *data, uint dataSize)
{
	memcpy(p->data, data, dataSize);
}

int _init_data(Bucket *p, void *data, uint dataSize)
{
	if (dataSize == sizeof(void *)) {
		memcpy(p->data, data, sizeof(void *));
	} else {
		p->data = (void *)malloc(dataSize);
		if (!p->data) {
			printf("failed");
			free(p);
			return FAILURE;
		}

		memcpy(p->data, data, dataSize);
	}
}

void _connect_to_bucket_dlist(Bucket *p, Bucket *list_head)
{
	p->pNext = list_head;
	p->pLast = NULL;
	if (p->pNext) {
		p->pNext->pLast = p;
	}
}

void _connect_to_global_dlist(Bucket *p, Hashtable *ht)
{
	p->pListLast = ht->pListTail;
	ht->pListTail = p;
	p->pListNext = NULL;
	if (p->pListLast != NULL) {
		p->pListLast->pListNext = p;
	}
	if (!ht->pListHead) {
		ht->pListHead = p;
	}
}

int _do_rehash(Hashtable *ht)
{
	Bucket *p;
	uint nIndex;
	int i = 0;

	if (ht->nNumOfElements == 0) {
		return SUCCESS;
	}

	memset(ht->hBuckets, 0, ht->nTableSize * sizeof(Bucket *));
	p = ht->pListHead;

	while (p != NULL) {
		nIndex = p->h & ht->nTableMask;
		_connect_to_bucket_dlist(p, ht->hBuckets[nIndex]);
		ht->hBuckets[nIndex] = p;
		p = p->pListNext;
	}

	return SUCCESS;
}

int _hash_if_full_resize(Hashtable *ht)
{
	Bucket **t;

	if (ht->nNumOfElements > ht->nTableSize) {
		if ((ht->nTableSize << 1) > 0) {
			t = (Bucket **)realloc(ht->hBuckets,
					       (ht->nTableSize << 1) *
						   sizeof(Bucket *));
			if (t) {
				ht->hBuckets = t;
				ht->nTableSize = (ht->nTableSize << 1);
				ht->nTableMask = ht->nTableSize - 1;
				_do_rehash(ht);
				return SUCCESS;
			}

			return FAILURE;
		}
	}

	return SUCCESS;
}

HASH_API hash_add_or_update(Hashtable *ht, const char *key, int keyLength,
			    void *data, uint dataSize, int flag)
{
	Bucket *p;
	uint nIndex;
	ulong newH = ht->hashFunction(key, keyLength);

	nIndex = newH & ht->nTableMask;
	p = ht->hBuckets[nIndex];
	while (p != NULL) {
		if (p->key == key ||
		    ((p->h == newH) && (p->keyLength == keyLength) &&
		     !memcmp(p->key, key, keyLength))) { // 更新操作
			if (flag &
			    HASH_ADD) { // 如果是插入操作,对应元素已经存在了，不进行插入操作
				return FAILURE;
			}

			if (ht->pDestructor) {
				ht->pDestructor(p->data);
			}

			_update_data(p, data, dataSize);
			return SUCCESS;
		}
		p = p->pNext;
	}

	p = (Bucket *)malloc(sizeof(Bucket) - 1 + keyLength);
	if (!p) {
		return FAILURE;
	}

	// 为新的p结点赋值
	memcpy(p->key, key, keyLength);
	p->keyLength = keyLength;
	_init_data(p, data, dataSize);
	p->h = newH;
	_connect_to_bucket_dlist(p, ht->hBuckets[nIndex]);
	_connect_to_global_dlist(p, ht);
	ht->hBuckets[nIndex] = p;
	++ht->nNumOfElements;

	_hash_if_full_resize(ht);

	return SUCCESS;
}

HASH_API hash_get(Hashtable *ht, const char *key, uint nKeyLength, void **data)
{
	Bucket *p;
	ulong h;
	uint nIndex;

	h = ht->hashFunction(key, nKeyLength);
	nIndex = h & ht->nTableMask;

	p = ht->hBuckets[nIndex];

	while (p != NULL) {
		if (p->key == key ||
		    ((p->h == h) && (p->keyLength == nKeyLength) &&
		     !memcmp(p->key, key, nKeyLength))) {
			*data = p->data;
			return SUCCESS;
		}
		p = p->pNext;
	}
	return FAILURE;
}

HASH_API hash_del_key_or_index(Hashtable *ht, const char *key, uint nKeyLength,
			       ulong h, int flag)
{
	uint nIndex;
	Bucket *p;

	if (flag == HASH_DEL_KEY) {
		h = ht->hashFunction(key, nKeyLength);
	}
	nIndex = h & ht->nTableMask;

	p = ht->hBuckets[nIndex];

	while (p != NULL) {
		if ((p->h == h) && (p->keyLength == nKeyLength) &&
		    ((p->keyLength == 0) || !memcmp(p->key, key, nKeyLength))) {
			if (p == ht->hBuckets[nIndex]) {
				ht->hBuckets[nIndex] = p->pNext;
			} else {
				p->pLast->pNext = p->pNext;
			}
			if (p->pNext) {
				p->pNext->pLast = p->pLast;
			}
			if (ht->pDestructor) {
				ht->pDestructor(p->data);
			}
			free(p);
			ht->nNumOfElements--;
			return SUCCESS;
		}

		p = p->pNext;
	}

	return FAILURE;
}

HASH_API hash_destroy(Hashtable *ht)
{
	Bucket *p, *q;

	p = ht->pListHead;
	while (p != NULL) {
		q = p;
		p = p->pListNext;
		if (ht->pDestructor) {
			ht->pDestructor(q->data);
		}
		hfree(q);
	}
	hfree(ht->hBuckets);
}

void hash_traversal(Hashtable *ht)
{
	Bucket *p;
	uint i;
	int flag = 0;
	for (i = 0; i < ht->nTableSize; i++) {
		p = ht->hBuckets[i];
		flag = 0;
		while (p != NULL) {
			printf("(%d %s <==> 0x%lX %d)    ", i, p->key, p->h,
			       p->pNext);
			p = p->pNext;
			flag = 1;
		}
		if (flag == 1) {
			printf("\n");
		}
	}
}

void hash_display_list(Hashtable *ht)
{
	Bucket *p;
	p = ht->pListTail;
	while (p != NULL) {
		printf("%s <==> 0x%lX \n", p->key, p->h);
		p = p->pListLast;
	}
}
