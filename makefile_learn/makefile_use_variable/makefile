OBJ = solution.o

solution : $(OBJ)
	g++ -o solution $(OBJ)
solution.o : solution.cpp
	g++ -c solution.cpp -o solution.o
clean :
	rm -f $(OBJ) solution