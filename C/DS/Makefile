obj = main.o linklist.o common.o

main: $(obj)
	cc -o main $(obj)

main.o: main.c common.h linklist.h
	cc -c main.c

linklist.o: linklist.c
	cc -c linklist.c

common.o: common.c linklist.h
	cc -c common.c

clean:
	rm -rf $(obj) main
