#include <stdio.h>

char *find_char( char const *source, char const *chars )
{
    char ch;
    char *p;
    while( (ch = *source++) != 0 )
    {
        for( p = (char *)chars; *p != 0; p++)
        {
            if( ch == *p )
                return p;
        }
    }
    return NULL;
}

int
main()
{
    char source[6] = "ABCDEF"; 
    char chars[3] = "XBZ";
    char *result = find_char(source, chars);
    if(result != NULL)
        printf("result: %c\n", *result);
	return 0;
}
