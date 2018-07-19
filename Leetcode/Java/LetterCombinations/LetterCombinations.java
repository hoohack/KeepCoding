import java.util.*;

public class LetterCombinations {

	public List<String> letterCombinations(String digits) {
		ArrayList<String> res = new ArrayList<>();
		res.add("");
		if (digits == null || digits.length() == 0) {
			return res;
		}

		HashMap<Integer, String> letterMap = new HashMap<>();
		letterMap.put(2, "abc");
		letterMap.put(3, "def");
		letterMap.put(4, "ghi");
		letterMap.put(5, "jkl");
		letterMap.put(6, "mno");
		letterMap.put(7, "pqrs");
		letterMap.put(8, "tuv");
		letterMap.put(9, "wxyz");

		for (int i = 0; i < digits.length(); i++) {
			Integer val = Integer.parseInt("" + digits.charAt(i));
			String letter = letterMap.get(val);

			ArrayList<String> newRes = new ArrayList<>();
			for (int j = 0; j < res.size(); j++) {
				for (int k = 0; k < letter.length(); k++) {
					newRes.add(res.get(j) + Character.toString(letter.charAt(k)));
				}
			}
			System.out.println(newRes);

			res = newRes;
		}

		return res;
	}

	public static void main(String[] args) {
		LetterCombinations s = new LetterCombinations();
		List<String> res = s.letterCombinations("234");
		for (String r: res) {
			System.out.println(r);
		}
	}
}
