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
            $emailN = $_SESSION['email'];
            $passN = $_SESSION['pass'];
            
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
                    if ( $email == $row["Email"] && $pass == $row["Password"] ){
                        echo "Email Match"; //here we are looking at one row, and printing the value in "names" column
                        $_SESSION['email'] = $email;
                        $_SESSION['pass'] = $pass;
                        header("Location: Home.php");
                        exit;
                    }
                    if ( $emailN == $row["Email"] && $passN == $row["Password"] ){
                        echo "Email Match"; //here we are looking at one row, and printing the value in "names" column
                        $_SESSION['email'] = $emailN;
                        $_SESSION['pass'] = $passN;
                        header("Location: Home.php");
                        exit;
                    }
                }
                header("Location: page2.php");
                exit;
            }
            
             /*sql query
            $sql = "INSERT INTO personal_account (Email) VALUES ('test')";
            echo "<br><br>Inserting  into db: ";
            if($conn->query($sql)==TRUE){       //try executing the query 
                echo "Query executed<br>";
            }
            else{
                echo "Query did not execute<br>";
            }*/
            
            
            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>
