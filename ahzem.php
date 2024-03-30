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

    <label for="finish">Enter ending number:</label>
    <input type="number" name="finish" id="finish" required>

    <label for="step">Enter step value:</label>
    <input type="number" name="step" id="step" required>

    <button type="submit">Generate Sequences</button>
</form>

<?php
class Collatz {
    public $start;
    public $end;
    public $collatzArray = [];
    public $step;

    public function __construct($start, $end, $step) {
        $this->start = $start;
        $this->end = $end;
        $this->step = $step;
        $this->generateSequence();
    }

    public function generateSequence() {
        for ($i = $this->start; $i <= $this->end; $i += $this->step) {
            $num = $i;
            $max = $i;
            $counter = 0;
            $sequence = [];

            while ($num != 1) {
                $sequence[] = $num;

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

            $sequence[] = $num;

            $this->collatzArray[] = [
                'initial' => $i,
                'final' => $num,
                'maximum' => $max,
                'counter' => $counter,
                'sequence' => $sequence
            ];
        }

        $this->printCollatzSequences();
    }

    public function printCollatzSequences() {
        foreach ($this->collatzArray as $info) {
            echo "Initial Number: {$info['initial']}<br>";
            echo "Final Number: {$info['final']}<br>";
            echo "Maximum number: {$info['maximum']}<br>";
            echo "Counter number: {$info['counter']}<br>";
            echo "Sequence: " . implode(' &rarr; ', $info['sequence']) . "<br>";

            echo "<br>";
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST["start"];
    $end = $_POST["finish"];
    $step = $_POST["step"];

    // Provide a default step value if not provided by the user
    $step = empty($step) ? 1 : $step;

    $collatz = new Collatz($start, $end, $step);
}
?>

</body>
</html>
