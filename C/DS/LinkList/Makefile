obj = main.o linklist.o common.o

CC = gcc

main: $(obj)
	$(CC) -o main $(obj)

main.o: main.c common.h linklist.h
	$(CC) -c main.c

linklist.o: linklist.c
	$(CC) -c linklist.c

common.o: common.c linklist.h
	$(CC) -c common.c

clean:
	rm -rf $(obj) main
