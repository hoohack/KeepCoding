obj = main.o hash.o

CC = gcc

main: $(obj)
	$(CC) -g -o main $(obj) 

main.o: main.c hash.h
	$(CC) -g -c main.c

hash.o: hash.c
	$(CC) -g -c hash.c

.PHONY: clean
clean:
	rm -rf $(obj) main
