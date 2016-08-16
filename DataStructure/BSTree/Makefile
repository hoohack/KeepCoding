obj = main.o bstree.o common.o

CC = gcc

main: $(obj)
	$(CC) -o main $(obj)

main.o: main.c common.h bstree.h
	$(CC) -c main.c

bstree.o: bstree.c
	$(CC) -c bstree.c

common.o: common.c bstree.h
	$(CC) -c common.c

.PHONY:clean
clean:
	-rm -rf $(obj) main
