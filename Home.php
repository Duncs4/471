<!DOCTYPE html>
<!--
Manmeet Dhaliwal
471 Sample project to show connection to local database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>It's the Home Page</title>
    </head>
    <body>
        Welcome to the home page, 
        <?php 
            session_start();
            $email = $_SESSION['email']; 
            echo $email;
            $servername = "localhost";          //should be same for you
            $username = "root";                 //same here
            $password = "foursevenone";             //your localhost root password
            $db = "temp";                     //your database name
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            
            //sql query
            $sql = "SELECT Name 
                    FROM personal_account
                    WHERE Email='$email'";

            /*
            if($conn->query($sql)==TRUE){       //try executing the query 
                echo "Query executed<br>";
            }
            else{
                echo "Query did not execute<br>";
            }
            */
            $result = $conn->query($sql); 
            $row = $result->fetch_assoc();
            echo $row["Name"];
            
            $sql = "SELECT * 
                    FROM product";
            
            echo "<br><br>Products:<br>";
            $result = $conn->query($sql);       //execute the query
            
            if($result->num_rows >0)
            {           //check if query results in more than 0 rows
                while($row = $result->fetch_assoc())
                {   //loop until all rows in result are fetched
                    echo $row["Name"];
                    //echo "<br><br>Name: "$row["Price"]"<br>";
                    //echo "<br><br>Name: "$row["Quantity"]"<br>";
                }
            }
            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>