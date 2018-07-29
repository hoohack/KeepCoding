import java.util.Stack;

public class ValidParentheses {

    public boolean isValid(String s) {
        if (s.length() == 0) {
            return true;
        }

        Stack<Character> stack1 = new Stack<>();

        for (int i = 0; i < s.length(); i++) {
            switch (s.charAt(i)) {
                case '(':
                case '[':
                case '{':
                    stack1.push(s.charAt(i));
                    break;
                case ')':
                    if (!stack1.empty() && stack1.pop() == '(') {
                        break;
                    } else {
                        return false;
                    }
                case ']':
                    if (!stack1.empty() && stack1.pop() == '[') {
                        break;
                    } else {
                        return false;
                    }
                case '}':
                    if (!stack1.empty() && stack1.pop() == '{') {
                        break;
                    } else {
                        return false;
                    }
                default:
                    return  false;
            }
        }

        return true;
    }

    public static void main(String[] args) {
        ValidParentheses s = new ValidParentheses();
        System.out.println(s.isValid("()[]{}"));
        System.out.println(s.isValid("(]"));
        System.out.println(s.isValid("{[]}"));
        System.out.println(s.isValid("([)]"));
    }
}