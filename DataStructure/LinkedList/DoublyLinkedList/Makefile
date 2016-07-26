obj = test.o list.o

CC = gcc

main: $(obj)
	$(CC) -g -o main $(obj)
test.o: test.c list.h
	$(CC) -g -c test.c
list.o: list.c list.h
	$(CC) -g -c list.c

.PHONY: clean
clean:
	rm -rf $(obj) main 
