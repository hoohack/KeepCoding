#ifndef HASH_H
#define HASH_H

#define DEFAULT_SIZE 32

#define SUCCESS 1
#define FAILURE -1

#define HASH_ADD			(1<<1)

#define HASH_DEL_KEY	0
#define HASH_DEL_INDEX  1

#define hfree(p) (free(p))

typedef unsigned int uint;
typedef unsigned long ulong;
typedef int HASH_API;

typedef void (*destruct)(void *pointer);
typedef ulong (*hash_func)(const char *key, uint nKeyLength);

typedef struct bucket {
	ulong h;
	void *data;
	int keyLength;
	struct bucket *pNext;
	struct bucket *pLast;
	struct bucket *pListLast;
	struct bucket *pListNext;
	
	char key[1];
}Bucket;

typedef struct _hashtable {
	Bucket **hBuckets;
	uint nNumOfElements;
	uint nTableSize; // always the next power of 2 greater or equal to nNumOfElements
	uint nTableMask;
	hash_func hashFunction;
	destruct pDestructor;
	Bucket *pListHead;
	Bucket *pListTail;
}Hashtable;

HASH_API hash_init(Hashtable *ht, hash_func hashFunction, destruct pDestrtcutor);
uint hash_table_size(Hashtable *ht);
uint hash_table_nums(Hashtable *ht);
HASH_API hash_add_or_update(Hashtable *ht, const char* key, int keyLength, void *data, uint dataSize, int flag);
HASH_API hash_get(Hashtable *ht, const char *key, uint nKeyLength, void **data);
HASH_API hash_del_key_or_index(Hashtable *ht, const char *key, uint nKeyLength, ulong h, int flag);
HASH_API hash_destroy(Hashtable *ht);
void hash_traversal(Hashtable *ht);
void hash_display_list(Hashtable *ht);
#endif
