#include <stdio.h>
#include "linklist.h"
#include "common.h"

int
main(){
    LinkList head = NULL;
    Init(head);
    int i = 0;
    for( i = 0; i < 10; ++i )
    {
        Insert(head, i);
    }
    PrintList(head);
    return 0;
}
