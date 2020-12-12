import java.util.*;
import java.nio.file.Files;
import java.nio.file.Paths;

public class One {
    public static void main(String[] args) {
        String inputString = new String(Files.readAllBytes(Paths.get(getClass().getResource("input.txt").getPath())));

        String[] inputArray = inputString.split("\n\n");

        int total = 0;

        for (String group : inputArray) {
            Set<Character> uniqueAnswers = new HashSet<Character>();

            String[] people = group.split("\n");

            for (String person : people) {
                char[] answers = person.toCharArray();

                for (char answer : answers) {
                    uniqueAnswers.add(answer);
                }
            }

            total += uniqueAnswers.size();
        }

        System.out.println(total);
    }
}
