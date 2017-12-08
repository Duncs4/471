<!DOCTYPE html>
<!--
Manmeet Dhaliwal
471 Sample project to show connection to local database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello</title>
    </head>
    <body>
        
        <?php
            session_start();
            // put your code here
            $email = $_GET["Email"];
            $pass = $_GET["Password"];
            $name = $_GET["Name"];
            
            $servername = "localhost";          //should be same for you
            $username = "root";                 //same here
            $password = "foursevenone";             //your localhost root password
            $db = "temp";                     //your database name
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            
            //sql query
            $sql = "SELECT Email, Password 
                    FROM personal_account";
            echo "<br><br>Checking Accounts:<br>";
            $result = $conn->query($sql);       //execute the query
            
            if($result->num_rows >0)
            {           //check if query results in more than 0 rows
                while($row = $result->fetch_assoc())
                {   //loop until all rows in result are fetched
                    if ( $email == $row["Email"]){
                        echo "Email Already Associated With An Account"; //here we are looking at one row, and printing the value in "names" column
                        header("Location: create.php");
                        exit;
                    }
                }
            }
            
            // sql query
            $sql = "INSERT INTO personal_account (Email, Password, Name)
                    VALUES ('$email', '$pass', '$name')";
            echo "<br><br>Inserting  into db: ";
            if($conn->query($sql)==TRUE){       //try executing the query 
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $pass;
                header("Location: demoPage.php");
                exit;
            }
            else{
                echo "Query did not execute<br>";
            }
            $conn-> close();            //close the connection to database
            //header("Location: page2.php");
            //exit;
        ?>
    </body>
</html>
