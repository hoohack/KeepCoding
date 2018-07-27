#include <unistd.h>
#include <stdlib.h>

#define BLOCK_SIZE 24

void *first_block = NULL;

typedef struct s_block *t_block;
struct s_block {
	size_t size;
	t_block prev;
	t_block next;
	int free;
	int padding;
	void *ptr;
	char data[1];
};

t_block get_block(void *p)
{
	char *tmp;
	tmp = p;
	return (p = tmp -= BLOCK_SIZE);
}

int valid_addr(void *p)
{
	if (first_block) {
		if (p > first_block && p < sbrk(0)) {
			return p == (get_block(p))->ptr;
		}
	}

	return 0;
}

t_block fusion(t_block b)
{
	if (b->next && b->next->free) {
		b->size += BLOCK_SIZE + b->next->size;
		b->next = b->next->next;
		if (b->next) {
			b->next->prev = b;
		}
	}

	return b;
}

void free(void *p)
{
	t_block b;
	if (valid_addr(p)) {
		b = get_block(p);
		b->free = 1;
		if (b->prev && b->prev->free) {
			b = fusion(b->prev);
		}

		if (b->next) {
			fusion(b);
		} else {
			if (b->prev) {
				b->prev->prev = NULL;
			} else {
				first_block = NULL;
			}
			brk(b);
		}
	}
}

int main()
{
	char *s = malloc(sizeof(char *) * 10);
	free(s);
	return 0;
}
