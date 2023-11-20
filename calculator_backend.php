<?php
header("Access-Control-Allow-Methods: GET");
$action = htmlspecialchars($_GET['action']);//security for xss
//echo $action;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($action)) {
    if ($action == 'calculator')
        calculator();
    elseif ($action == 'bot')
        bot();
    else
        echo "Invalid action";
}
function calculator()
{
    try {
        $num1 = htmlspecialchars($_GET["num1"]);//security for xss
        $num2 = htmlspecialchars($_GET["num2"]);//security for xss
        $operator = htmlspecialchars($_GET["operator"]);//security for xss
        if (!isset($num1) || !isset($num2) || !isset($operator)) {
            throw new Exception('Missing parameters');
        }
        if (!is_numeric($num1) || !is_numeric($num2) || !(1 <= $operator && $operator <= 4)) {
            throw new Exception('Invalid parameters');
        }
        echo performCalculation($num1, $operator, $num2);
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

function bot()
{
    try {
        $calculations = [];
        for ($i = 0; $i < 1000; $i++) {
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            $operator = rand(1, 4);

            $startTime = microtime(true);
            $result = performCalculation($num1, $operator, $num2);
            $endTime = microtime(true);
            $duration = $endTime - $startTime;

            $calculations[] = [
                'num1' => $num1,
                'operator' => $operator,
                'num2' => $num2,
                'result' => $result,
                'duration' => $duration,
            ];
        }

        $jsonData = json_encode($calculations, JSON_PRETTY_PRINT);
        $directoryName = "calculations";
        if (!is_dir($directoryName)) {
            mkdir($directoryName, 0777, true);
        }
        $fileName = $directoryName . '/' . date('Y-m-d-H-i-s') . '.json';
        file_put_contents($fileName, $jsonData);
        echo "File saved to " . $fileName . " successfully".PHP_EOL;
        //create link to open new tab
        echo "<a href='$fileName' target='_blank'>Open file</a>";

//        $file = fopen($fileName, "r") or die("Unable to open file!");
//        //Output a line of the file until the end is reached
//        while (!feof($file)) {
//            echo fgets($file) . "<br>";
//        }
//        fclose($file);

    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

function performCalculation($num1, $operator, $num2)
{
    switch ($operator) {
        case '1':
            return $num1 + $num2;
        case '2':
            return $num1 - $num2;
        case '3':
            return $num1 * $num2;
        case '4':
            return $num1 / $num2;
        default:
            return null;
    }
}

?>
