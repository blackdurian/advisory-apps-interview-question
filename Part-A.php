<?php

echo "<h1>Part A </h1>";
//1. Given a = 19, b = 75, swap the two variable value without using a 3rd variable.
echo "<br>1. Given a = 19, b = 75, swap the two variable value without using a 3rd variable.<br><br>";

$a = 19;
$b = 75;
printf("before swapping a = %d, b = %d <br>",$a,$b);
$a = $a + $b;
$b = $a - $b;
$a = $a - $b;
printf("after swapping a = %d, b = %d <br>",$a,$b);

//2. Tropicana Avenue provide internet download speed up to 100 Mbps(Megabits Per Second), calculate the speed in KB/s(kiloBytes)?
echo "<br>2. Tropicana Avenue provide internet download speed up to 100 Mbps(Megabits Per Second), calculate the speed in KB/s(kiloBytes)?<br><br>";
echo "100Mbp/s equals to ".MbpsToKBs(100)." Kb/s .<br>" ;

function MbpsToKBs($Mbps){
    return $Mbps*125;
}

//3. What is the potential problem in the query written in PHP as follows?
echo "<br>3. What is the potential problem in the query written in PHP as follows?<br> ";
echo  "\$query=\"SELECT * FROM table WHERE id = \$_POST['id']\"<br><br>";
echo "<a href=\"https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/\">SQL Injection</a>  - An attacker can use it to make a web application process and execute injected SQL statements as part of an existing SQL query.<br>";
echo "<a href=\"https://www.w3schools.com/php/php_mysql_prepared_statements.asp\">Using Prepared Statements</a> could be a better way to prevent risk from SQL Injections.<br>";

//4. WHEN the a above is folded is form a cube, just two of the following can be produced. Which two?
echo "<br> 4. WHEN the a above is folded is form a cube, just two of the following can be produced. Which two?<br><br>";
echo "A, E <br>";

//5.  Write code to separate between even and odd number to each new array and Given values[10] = {8,10,7,3,2,9,1,5,4,6}
echo "<br>5.  Write code to separate between even and odd number to each new array and Given values[10] = {8,10,7,3,2,9,1,5,4,6}<br><br>";

$odd_numbers = array();
$even_numbers = array();
$given_values = array(8,10,7,3,2,9,1,5,4,6);

foreach ($given_values as $number) {
    if ($number % 2 == 0) {
        array_push($even_numbers, $number);
    } else {
        array_push($odd_numbers, $number);
    }
}
echo "even numbers :". json_encode($even_numbers)."<br>";
echo "odd numbers :".json_encode($odd_numbers)."<br>";

// 6. ABC Shipping company able to fit 8 huge boxes or 10 small boxes in a carton for shipping. Last week, they manage to send out 96 boxes. How many cartons did they shipped? (Quantity of Huge boxes > Quantity of Small boxes)
echo "<br>6. ABC Shipping company able to fit 8 huge boxes or 10 small boxes in a carton for shipping. Last week, they manage to send out 96 boxes.
      <br> How many cartons did they shipped? (Quantity of Huge boxes > Quantity of Small boxes)<br><br>";
echo "11 cartons, if a carton can fill 6 huge boxes and 2 small boxes at the same time. Otherwise  12 cartons needed<br>";