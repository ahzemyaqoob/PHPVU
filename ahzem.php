<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture</title>
</head>
<body>

<h1>Collatz Conjecture</h1>

<form method="post" action="http://localhost/php/p%202.php">
    <label for="start">Enter starting number:</label>
    <input type="number" name="start" id="start" required>

    <label for="finsh">Enter ending number:</label>
    <input type="number" name="finsh" id="finsh" required>

    <button type="submit">Generate Sequences</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST["start"];
    $end = $_POST["finsh"];
    $collatzArray = [];  // Initialize an empty array to store Collatz sequence information.

    for ($i = $start; $i <= $end; $i++) {
        $num = $i;
        $max = $i;
        $counter = 0;

        $sequence = [];  // Initialize an empty array to store the Collatz sequence.

        while ($num != 1) {
            $sequence[] = $num;  // Store the current number in the sequence array.

            if ($num % 2 == 0) {
                $num = $num / 2;
            } else {
                $num = 3 * $num + 1;
            }

            if ($num > $max) {
                $max = $num;
            }

            $counter++;
        }

        // Store the last number (1) in the sequence array.
        $sequence[] = $num;

        // Store the Collatz sequence information in the main array.
        $collatzArray[] = [
            'initial' => $i,
            'final' => $num,
            'maximum' => $max,
            'counter' => $counter,
            'sequence' => $sequence
        ];
    }

    // Print the stored Collatz sequence information.
    foreach ($collatzArray as $info) {
        echo "Initial Number: {$info['initial']}<br>";
        echo "Final Number: {$info['final']}<br>";
        echo "Maximum number: {$info['maximum']}<br>";
        echo "Counter number: {$info['counter']}<br>";
        echo "Sequence: " . implode(' &rarr; ', $info['sequence']) . "<br>";
        echo "<br>";
    }
}
?>

</body>
</html>

