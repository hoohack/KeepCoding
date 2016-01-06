#include <stdio.h>

int
del_substr( char *str, char const *substr )
{
    char *s1 = str;
    char *s2 = (char *)substr;
    char *source = NULL;
    int count = 0;
    int len = 0;
    while( *s1 != '\0' )
    {
        count = 0;
        source = s1;
        s2 = (char *)substr;
        while( *s2 != '\0' && *s1 != '\0' && *s2 == *s1 )
        {
            s2++;
            s1++;
            count++;
        }

        if( *s2 == '\0' )
        {
            len = count;
            while( *source != '\0' && count-- )
            {
                *source = *(source + len);
                source++;
            }
            return 1;
        }
        s1++;
    }
    
    return 0;
}

int
main()
{
	char str[7] = "ABCDEFG";
	char substr[3] = "CDE";
	int result = 0;	
	result = del_substr(str, substr);
    if( result != 0)
    {
	    printf("%s\n", str);
    }else{
        printf("not found\n");
    }
	return 0;
}
