<?php

$states = array(
    "New York (state)" => array(
        "New York" => 8175133
    ),
    "California" => array(
        "Los-Angles" => 3792621,
        "San-Diego" => 1307402,
        "San-Hose" => 945942
    ),
    "Illinois" => array(
        "Chicago" => 2695598
    ),
    "Texas" => array(
        "Houston" => 2100263,
        "San-Antonio" => 1327407,
        "Dallas" => 1197816,
    ),
    "Pennsylvania" => array(
        "Philadelphia" => 1526006
    ),
    "Arizona" => array(
        "Phoenix" => 1445632
    ),
);

function showArrAsTable(&$arr = array())
{
    echo "<table style='border: 1px solid'><tbody>";

    foreach ($arr as $item => $value) {
        echo "<tr>";
        echo "<th style='border: 1px solid'>$item</th>";

        asort($value, SORT_NUMERIC);

        foreach ($value as $key => $val) {
            if (is_numeric($val))
                $number = number_format($val);

            echo "<td style='border: 1px solid'>$key: $number</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table><br>";
/////////////////////////////////////////////////////////////////////
    echo "<table style='border: 1px solid'><tbody>";

    ksort($arr);

    foreach ($arr as $item => $value) {
        echo "<tr>";
        echo "<th style='border: 1px solid'>$item</th>";

        ksort($value);

        $population = 0;
        foreach ($value as $key => $val) {
            if (is_numeric($val)) {
                $population += $val;
                $number = number_format($val);
            }
            echo "<td style='border: 1px solid'>$key: $number</td>";
        }
        $population = number_format($population);

        echo "<td><b>$population</b></td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}

showArrAsTable($states);
