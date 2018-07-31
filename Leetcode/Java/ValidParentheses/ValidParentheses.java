import java.util.Stack;

public class ValidParentheses {

    public boolean isValid(String s) {
        if (s.length() == 0) {
            return true;
        }

        Stack<Character> stack = new Stack<>();

        for (int i = 0; i < s.length(); i++) {
            if (s.charAt(i) == '(' || s.charAt(i) == '[' || s.charAt(i) == '{') {
                stack.push(s.charAt(i));
                continue;
            }

            if (!stack.empty() &&
                    ((s.charAt(i) == ')' && stack.pop() == '(') ||
                    (s.charAt(i) == ']' && stack.pop() == '[') ||
                    (s.charAt(i) == '}' && stack.pop() == '{'))) {
                continue;
            } else {
                return false;
            }
        }

        return stack.empty();
    }

    public static void main(String[] args) {
        ValidParentheses s = new ValidParentheses();
        System.out.println(s.isValid("()[]{}"));
        System.out.println(s.isValid("(]"));
        System.out.println(s.isValid("{[]}"));
        System.out.println(s.isValid("([)]"));
    }
}
