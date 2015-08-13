/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */
struct ListNode* reverseList(struct ListNode* head) {
    if (head == NULL)
    {
    	return NULL;
	}
	struct ListNode *p, *q;
	p = q = NULL;
	
	while(head->next != NULL)
	{
		q = head->next;
		head->next = p;
		p = head;
		head = q;
	}
	head->next = p;
	
	return head;
}