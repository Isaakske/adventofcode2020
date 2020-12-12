import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.nio.file.Files;
import java.nio.file.Paths;

public class One {
    public static void main(String[] args) {
        String inputString = new String(Files.readAllBytes(Paths.get(getClass().getResource("input.txt").getPath())));

        String[] inputArray = inputString.split("\n");
        List<Integer> ids = new ArrayList<Integer>();

        for (String input : inputArray) {
            char[] in = input.toCharArray();
            double minRow = 0;
            double maxRow = 127;
            double minColumn = 0;
            double maxColumn = 7;

            for (int i = 0; i<7; i++) {
                switch (in[i]) {
                    case 'F' -> maxRow = Math.floor(maxRow - ((maxRow - minRow) / 2));
                    case 'B' -> minRow = Math.ceil(minRow + ((maxRow - minRow) / 2));
                }
            }

            for (int i = 7; i<10; i++) {
                switch (in[i]) {
                    case 'L' -> maxColumn = Math.floor(maxColumn - ((maxColumn - minColumn) / 2));
                    case 'R' -> minColumn = Math.ceil(minColumn + ((maxColumn - minColumn) / 2));
                }
            }

            ids.add((int) (minRow * 8 + minColumn));
        }

        System.out.println(Collections.max(ids));
    }
}
