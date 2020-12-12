import java.util.*;
import java.nio.file.Files;
import java.nio.file.Paths;

public class One {
    public static void main(String[] args) {
        String inputString = new String(Files.readAllBytes(Paths.get(getClass().getResource("input.txt").getPath())));

        String[] inputArray = inputString.split("\n\n");

        int total = 0;

        for (String group : inputArray) {
            Character[] chars = group
                    .chars()
                    .mapToObj(c -> (char) c)
                    .toArray(Character[]::new);

            Set<Character> uniqueAnswers = new HashSet<>(Arrays.asList(chars));

            total += uniqueAnswers
                    .stream()
                    .filter(c -> c != '\n')
                    .count();
        }

        System.out.println(total);
    }
}
