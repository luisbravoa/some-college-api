<?php

$dir = 'sqlite:C:\Users\luis_\code\some-college\database\database.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");
$query =  "
CREATE TABLE COMPANY(
   ID INT PRIMARY KEY     NOT NULL,
   NAME           TEXT    NOT NULL,
   AGE            INT     NOT NULL,
   ADDRESS        CHAR(50),
   SALARY         REAL
);
";
foreach ($dbh->query($query) as $row)
{
    echo $row[0];
}