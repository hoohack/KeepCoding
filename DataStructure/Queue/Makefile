obj = main.o queue.o common.o

CC = gcc

main: $(obj)
	$(CC) -g -o main $(obj)

main.o: main.c common.h queue.h
	$(CC) -g -c main.c

queue.o: queue.c
	$(CC) -g -c queue.c

common.o: common.c queue.h
	$(CC) -g -c common.c

.PHONY:clean
clean:
	-rm -rf $(obj) main
