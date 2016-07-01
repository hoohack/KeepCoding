#include "hash.h"
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

ulong my_hash_func(const char *key, uint nKeyLength)
{
	ulong hash = 5381;

	for (; nKeyLength >= 8; nKeyLength -= 8) {
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
		hash = ((hash << 5) + hash) + *key++;
	}

	switch (nKeyLength) {
	case 7:
		hash = ((hash << 5) + hash) + *key++;
	case 6:
		hash = ((hash << 5) + hash) + *key++;
	case 5:
		hash = ((hash << 5) + hash) + *key++;
	case 4:
		hash = ((hash << 5) + hash) + *key++;
	case 3:
		hash = ((hash << 5) + hash) + *key++;
	case 2:
		hash = ((hash << 5) + hash) + *key++;
	case 1:
		hash = ((hash << 5) + hash) + *key++;
		break;
	case 0:
		break;
	}

	return hash;
}

int main()
{
	Hashtable ht;
	hash_init(&ht, my_hash_func, NULL);
	int i;
	char ch[20];
	int *data;
	int k = 0;
	void *find_val;
	int res;

	for (i = 30; i < 68; i++) {
		sprintf(ch, "%d", i);
		ch[strlen(ch) + 1] = '\0';
		data = malloc(sizeof(int));
		*data = i - 30;
		hash_add_or_update(&ht, ch, strlen(ch) + 1, data, sizeof(int),
				   0);
	}
	hash_traversal(&ht);
	sprintf(ch, "%d", 67);
	hash_del_key_or_index(&ht, ch, strlen(ch) + 1, 0, HASH_DEL_KEY);
	hash_traversal(&ht);
	sprintf(ch, "%d", 66);
	res = hash_get(&ht, ch, strlen(ch) + 1, &find_val);
	if (res == SUCCESS) {
		printf("found %s => %d\n", ch, *(int *)find_val);
	}
	hash_destroy(&ht);
	return 0;
}
