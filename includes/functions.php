<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/**
 * To insert the new user
 * @param name
 * @param email
 * @param number
 * @param course_type
 * @param batch
 * @param password
 * @return integer
 * */
function insertUser($name, $email, $number, $course_type, $batch, $password)
{
    global $conn;
    $sql = "Select * from user where email ='$email'";
    if (($result = $conn->query($sql)) && (mysqli_num_rows($result) > 0)) {
        return -1;
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO user (name, email, number, course_type, batch, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $number, $course_type, $batch, $password);
        $stmt->execute();
        $stmt->close();
        return 1;
    }
}

/**
 * get particular User through email and password
 * @param string
 * @param string
 * @return array
 */
function getUser($email, $password)
{
    global $conn;
    $user = array();
    $sql = "Select * from user where email ='$email' && password = '$password'";
    if (($result = $conn->query($sql)) && (mysqli_num_rows($result) > 0)) {
        while($row = $result->fetch_assoc())
        {
            $user = array(
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'number' => $row['number'],
                'course_type' => $row['course_type'],
                'batch' => $row['batch'],
                'admin' => $row['admin'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ); 
        }
        return $user;
    }
    else
    {
        return -1;
    }
}

/**
 * get particular User through user_id
 * @param integer
 * @return array
 */
function getUserById($user_id)
{
    global $conn;
    $user = array();
    $sql = "Select * from user where user_id = $user_id";
    if (($result = $conn->query($sql)) && (mysqli_num_rows($result) > 0)) {
        while($row = $result->fetch_assoc())
        {
            $user = array(
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'number' => $row['number'],
                'course_type' => $row['course_type'],
                'batch' => $row['batch'],
                'admin' => $row['admin'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ); 
        }
        return $user;
    }
    else
    {
        return -1;
    }
}

/**
 * insert random confirmation code and send it to via mail to user
 * @param string
 * @return integer
 */
function getConfCode($email)
{
    global $conn;
    $user = array();
    $conf_code = mt_rand(100000, 999999);
    $sql = "Select * from user where email = '$email'";
    if (($result = $conn->query($sql)) && (mysqli_num_rows($result) > 0)) {
        while($row = $result->fetch_assoc())
        {
            $user_id = $row['user_id'];
        }
        
        $sql_update = "Update user SET conf_code=$conf_code WHERE user_id=$user_id";
        $result_update = $conn->query($sql_update);

        //mail function

        return $user_id;

    }
    else
    {
        return -1;
    }
}
/**
 * update user's password via emailVerification screen
 * @param integer
 * @param string
 * @param string
 * @return integer
 */
function updatePassword($conf_code, $user_id, $password)
{
    global $conn;
    $user = array();
    
    $sql = "Select * from user where user_id = $user_id AND conf_code = $conf_code";
    if (($result = $conn->query($sql)) && (mysqli_num_rows($result) > 0)) {
        $sql_update = "Update user SET conf_code=NULL, password='".$password."' WHERE user_id=$user_id";
        $result_update = $conn->query($sql_update);
        
        return $user_id;
    }
    else
    {
        return -1;
    }
}
