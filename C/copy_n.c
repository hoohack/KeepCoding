 #include <stdio.h>
 #include <string.h>

void
copy_n(char dst[], char src[], int n)
{
    int dst_index = 0, src_index = 0;

    for( ; dst_index < n; dst_index++ )
    {
        dst[dst_index] = src[src_index];
        if( src[src_index] != 0 )
        {
            ++src_index;
        }
    }

}

int
main()
{
    char src[10] = "abcdefghi";
    char dst[5];

    copy_n(dst, src, 5);
    printf("%s\n", src);
    printf("%s\n", dst);
    return 0;
}
