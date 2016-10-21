obj = main.o list.o

CC = gcc

main: $(obj)
	$(CC) -o main $(obj)

main.o: main.c list.h
	$(CC) -c main.c

list.o: list.c
	$(CC) -c list.c

.PHONY:clean
clean:
	-rm -rf $(obj) main
