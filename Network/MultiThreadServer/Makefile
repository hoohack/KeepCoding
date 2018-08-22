sobj = server.o
cobj = client.o

CC = gcc

server: $(sobj)
	$(CC) -o server $(sobj)

client: $(cobj)
	$(CC) -o client $(cobj)

server.o: server.c
	$(CC) -c -pthread server.c

client.o: client.c
	$(CC) -c client.c

.PHONY:clean
clean:
	-rm -rf $(sobj) $(cobj) client server
