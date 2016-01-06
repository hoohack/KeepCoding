#include <stdio.h>
#include <string.h>

int
substr( char dst[], char src[], int start, int len)
{
	int src_len = strlen(src);
	int i = 0;
	if( start > src_len || start < 0 || len < 0 )
	{
		strcpy(dst, "");
	}

	int j = 0;
	for (i = start; i < start + len; ++i)
	{
		dst[j++] = src[i];
	}

	int dst_len = strlen(dst);
	dst[dst_len] = '\0';
	return dst_len;
}

int
main()
{
	char src[10] = "abcdefghij";
	char dst[5] = "";
	int result = substr(dst, src, 5, 5);
	printf("result %d dst %s \n", result, dst);
	return 0;
}