obj = main.o rbtree.o

CC = gcc

main: $(obj)
	$(CC) -g -o main $(obj)

main.o: main.c rbtree.h
	$(CC) -g -c main.c

rbtree.o: rbtree.c
	$(CC) -g -c rbtree.c

.PHONY: clean
clean:
	rm -rf $(obj) main

