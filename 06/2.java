import java.util.*;
import java.nio.file.Files;
import java.nio.file.Paths;

public class Two {
    public static void main(String[] args) {
        String inputString = new String(Files.readAllBytes(Paths.get(getClass().getResource("input.txt").getPath())));

        String[] inputArray = inputString.split("\n\n");

        int total = 0;

        for (String group : inputArray) {
            Map<Character, Integer> amountOfAnswers = new HashMap<>();

            String[] people = group.split("\n");

            for (String person : people) {
                char[] answers = person.toCharArray();

                for (char answer : answers) {
                    amountOfAnswers.put(answer, amountOfAnswers.getOrDefault(answer, 0) + 1);
                }
            }

            total += amountOfAnswers
                    .entrySet()
                    .stream()
                    .filter(entry -> entry.getValue() == people.length)
                    .count();
        }

        System.out.println(total);
    }
}
