<?php
class Calendar{
    private $year;
    private $month;

    public function __construct($y, $m){
        $this->year = $y;
        $this->month = $m;
    }

    public function create_rows(){
        $last_day = date("j", mktime(0,0,0,$this->month + 1, 0, $this->year));

        $rows = array();
        $row = self::init_row();

        for( $i = 1; $i <= $last_day; $i++ ) {
            $date = Date("w", mktime(0,0,0,$this->month,$i,$this->year));
            $row[$date] = $i;

            if($date == 6 || $i == $last_day) {
                $row[] = $row;
                $row = self::init_row();
            }
        }
        return $rows;
    }

    public function get_info() {
        return $this->year . "-" . $this->month;
    }

    private static function init_row() {
        $ary = array();
        for( $i = 0; $i <= 6; $i++ ) {
            $ary[] = "・";
        }
        return $ary;
    }
}

$year = Date("Y");
$month = Date("n");
$cal = new Calendar($year, $month);

echo <<< EOL

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <titile>Calender</title>
            <style>
                h1 { 
                    font-size: 18px;
                    margin: 0;  
                }

                th {
                    background-color: #CC6;
                    font-size: 13px;
                    text-align: center;
                }

                td {
                    background-color: #EEE;
                    font-size: 13px;
                    text-align: center;
                }

                input[type="text"] {
                    width: 35px;
                }
            </style>
    </head>
    <body>
        <h1>
            EOL;
            echo $cal->get_info();

            echo <<<EOL
        </h1>
        <table>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            EOL;

            foreach( $cal->create_rows() as $row ) {
                echo "<tr>"

                for( $i=0; $i<=6; $i++ ) {
                    echo "<td>" . $row[$i]. "</td>";
                }

                echo "</tr>";
            }

            echo <<< EOL
        </table>
    </body>
</html>
EOL;

?php>