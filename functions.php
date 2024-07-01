<?php
function DisplayAllUsers($con) {
    $sql = "SELECT UserID, Username FROM Users";
    $result = $con->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row; // Store user data in array
        }
    }
    return $users; // Return array of users
}


function CheckLogin($con) {
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $query = "SELECT * FROM Users WHERE UserID = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }
    return null; // Return null if no user is logged in or query fails
}

?>
