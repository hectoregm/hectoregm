<?php

// Creates a secure session
function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = SECURE;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../index.php?err=Could not initiate a safe session");
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // Sets the session name to the one set above.
    session_name($session_name);

    session_start();            // Start the PHP session
    session_regenerate_id();    // Regenerated the session, delete the old one.
}

// Helper method that queries the DB to check is the user and password
// are valid, returns a boolean
function login($username, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id, username, pass
                                  FROM usuarios
                                  WHERE username = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();

        // TODO: Password are in cleartext we need to hash the password with the unique salt.
        //$password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {

            if ($db_password == $password) {
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                // Password is correct!
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                return true;
            } else {
                // Wrong username/password
                return false;
            }
        } else {
            // No user exists.
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../index.php?error=Database error: cannot prepare statement");
        exit();
    }
}


// Helper method to check if a user is logged in
function login_check($mysqli) {
    // Check if all session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT pass
                      FROM usuarios
                      WHERE id = ? LIMIT 1")) {

            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: ../index.php?error=Database error: cannot prepare statement");
            exit();
        }
    } else {
        // Not logged in
        return false;
    }
}

function is_admin($mysqli) {
    $user_id = $_SESSION['user_id'];

    if (login_check($mysqli) == true) {
        // Is a logged user
        if ($stmt = $mysqli->prepare("SELECT id, username, admin
                                          FROM usuarios
                                          WHERE id = ? AND admin = 1 LIMIT 1")) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // Admin in the house
                return true;
            } else {
                // Not admin
                return false;
            }
        }
    } else {
        // Not admin
        return false;
    }
}

function can_edit($mysqli, $id) {
    $user_id = $_SESSION['user_id'];

    if ($stmt = $mysqli->prepare("SELECT id, admin
                                          FROM usuarios
                                          WHERE id = ? LIMIT 1")) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $admin);
            $stmt->fetch();

            if ($_SESSION['user_id'] == $user_id &&
                ($_SESSION['user_id'] == $id ||
                 $admin == 1)) {
                // Admin or owner of record
                return true;
            } else {
                // Not admin or owner of record
                return false;
            }
        } else {
            // No valid user
            return false;
        }
    }
}
?>