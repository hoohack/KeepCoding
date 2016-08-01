obj = main.o stack.o common.o

CC = gcc

main: $(obj)
	$(CC) -g -o main $(obj)

main.o: main.c common.h stack.h
	$(CC) -g -c main.c

stack.o: stack.c
	$(CC) -g -c stack.c

common.o: common.c stack.h
	$(CC) -g -c common.c

.PHONY:clean
clean:
	-rm -rf $(obj) main
