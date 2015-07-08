// Implement the following operations of a stack using queues.

class Stack {
public:
    // Push element x onto stack.
    void push(int x) {
        q.push(x);
    }

    // Removes the element on top of the stack.
    void pop() {
    	int size = q.size();
    	for (int i = 1; i < size; ++i)
    	{
    		q.push(q.front());
    		q.pop();
		}
		q.pop();
    }

    // Get the top element.
    int top() {
    	int size = q.size();
    	for (int i = 1; i < size; ++i)
    	{
    		q.push(q.front());
    		q.pop();
		}
		int result = q.front();
		q.push(q.front());
		q.pop();
		return result;
    }

    // Return whether the stack is empty.
    bool empty() {
        return q.empty();
    }
private:
	queue<int> q;
};