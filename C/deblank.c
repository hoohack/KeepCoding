#include <stdio.h>
#include <string.h>

void
deblank( char string[] )
{
	int len = strlen(string);
	int i = 0, j = 0;
	char cp[len];
	for( i = 0; i < len; ++i )
	{
		if( string[i] != ' ' || (string[i] == ' ' && string[i+1] != ' ') )
		{
			cp[j++] = string[i];
		}
	}
	cp[j] = '\0';
	strcpy(string, cp);
}

int
main()
{
	char str[10] = "";
	fgets(str, sizeof(str), stdin);
	deblank(str);
	printf("result %s\n", str);
	return 0;
}