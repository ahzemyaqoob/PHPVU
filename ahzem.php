<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture</title>
</head>
<body>

<h1>Collatz Conjecture</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="start">Enter starting number:</label>
    <input type="number" name="start" id="start" required>

    <label for="finish">Enter ending number:</label>
    <input type="number" name="finish" id="finish" required>

    <button type="submit">Generate Sequences</button>
</form>

<?php
class Collatz {
    protected $start;
    protected $end;
    protected $collatzArray = [];

    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
        $this->generateSequence();
    }

    protected function generateSequence() {
        for ($i = $this->start; $i <= $this->end; $i++) {
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

class CollatzWithStats extends Collatz {
    public function calculateHistogram() {
        $histogram = [];
        foreach ($this->collatzArray as $info) {
            $final = $info['final'];
            if (!isset($histogram[$final])) {
                $histogram[$final] = 0;
            }
            $histogram[$final]++;
        }
        return $histogram;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST["start"];
    $end = $_POST["finish"];

    // Validate input
    if (is_numeric($start) && is_numeric($end)) {
        $collatz = new Collatz($start, $end);
        $collatz->printCollatzSequences();
    } else {
        echo "Please enter valid numeric values for start and end.";
    }
}
?>

</body>
</html>

