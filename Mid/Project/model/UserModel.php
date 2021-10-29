<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";


function _get_users()
{
    $users = json_decode(file_get_contents(_CONFIG["DB_DIR"]), true);

    return ($users) ? $users : [];
}

function _get_user($email)
{
    $user = null;
    foreach (_get_users() as $u) {
        if ($u['email'] == $email) {
            $user = $u;
        }
    }
    return $user ? $user : [];
}

function _get_user_login($email, $password, $utype)
{
    foreach (_get_users() as $user) {
        if ($user['email'] === $email && $user['password'] === $password && $user['utype'] === $utype) {
            _set_session_val('name', $user['name']);
            _set_session_val('email', $user['email']);
            _set_session_val('password', $user['password']);
            _set_session_val('gender', $user['gender']);
            _set_session_val('dob', $user['dob']);
            _set_session_val('utype', $user['utype']);
            _set_session_val('pp_path', $user['pp_path']);

            _set_logged_in(true);

            if ($utype == "doctor") {
                _set_session_val("degree", $user['degree']);
                _set_session_val("institute", $user['institute']);
                _set_session_val("specialization", $user['specialization']);
            } else if ($utype == "patient") {
            } else if ($utype == "edoctor") {
                _set_session_val("degree", $user['degree']);
                _set_session_val("institute", $user['institute']);
                _set_session_val("specialization", $user['specialization']);
                _set_session_val("work_area", $user['work_area']);
            }

            break;
        }
    }

    return _get_is_logged_in();
}

function _is_duplication(&$messages, $email)
{
    // Format user associative array
    $flag = false;

    if (!empty(_get_users()) && _get_user($email)) {

        $messages["errors"][] = "Email already registered";

        $flag = true;
    }

    return $flag;
}

function _add_user($name, $email, $password, $gender, $utype, $dob, $dgree = "", $institute = "", $specialization = "", $work_area = "", $pp_path = "")
{
    $users = _get_users();

    $new_user = [
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "gender" => $gender,
        "utype" => $utype,
        "dob" => $dob,
        "pp_path" => $pp_path
    ];

    // Different user have different data
    if ($utype == "doctor") {
        $new_user["degree"] = $dgree;
        $new_user["institute"] = $institute;
        $new_user["specialization"] = $specialization;
    } else if ($utype == "patient") {
    } else if ($utype == "edoctor") {
        $new_user["degree"] = $dgree;
        $new_user["institute"] = $institute;
        $new_user["specialization"] = $specialization;
        $new_user["work_area"] = $work_area;
    }
    // Append new user
    $users[] = $new_user;

    // Convert associative array to json string
    $json = json_encode($users);

    // Put all the json string to the file
    file_put_contents(_CONFIG["DB_DIR"], $json);
}

function _edit_user($utype, $user, $pev_email)
{
    $users = _get_users();

    for ($i = 0; $i < count($users); ++$i) {
        if ($users[$i]['utype'] == $utype && $users[$i]['email'] == $pev_email) {
            // _var_dump($user);
            $users[$i]['name'] = $user['name'];
            $users[$i]['email'] = $user['email'];
            $users[$i]['gender'] = $user['gender'];
            $users[$i]['dob'] = $user['dob'];

            _set_session_val("name", $user['name']);
            _set_session_val("email", $user['email']);
            _set_session_val("gender", $user['gender']);
            _set_session_val("dob", $user['dob']);

            if (preg_match("/(doctor|edoctor)/", $utype) == 1) {
                $users[$i]['degree'] = $user['degree'];
                $users[$i]['institute'] = $user['institute'];
                $users[$i]['specialization'] = $user['specialization'];

                _set_session_val("degree", $user['degree']);
                _set_session_val("institute", $user['institute']);
                _set_session_val("specialization", $user['specialization']);
            }

            if ($utype == "edoctor") {
                $users[$i]['work_area'] = $user['work_area'];

                _set_session_val("work_area", $user['work_area']);
            }

            break;
        }
    }

    // Convert associative array to json string
    $json = json_encode($users);

    // Put all the json string to the file
    file_put_contents(_CONFIG["DB_DIR"], $json);

    // _var_dump($user);
    // _var_dump($users);
    // _var_dump($json);
}

function _upload_profile_pic($picture, $target_file)
{
    $is_uploaded = false;
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        // Get data from json
        $users = _get_users();

        // Find the user
        for ($i = 0; $i < count($users); ++$i) {
            if ($users[$i]['email'] == _get_session_val('email')) {
                // Set edited data to session
                _set_session_val("pp_path", $picture);

                // Change data in the array
                $users[$i]['pp_path'] = _get_session_val("pp_path");

                break;
            }
        }

        // Convert associative array to json string
        $json = json_encode($users);
        // Put all the json string to the file
        file_put_contents(_CONFIG["DB_DIR"], $json);

        $is_uploaded = true;
    }

    return $is_uploaded;
}

function _change_password($email, $newpass)
{
    $is_pass_changed = false;

    // Get data from json
    $users = _get_users();

    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['email'] == $email) {
            // Set edited data to session
            _set_session_val("password", $newpass);

            // Change data in the array
            $users[$i]['password'] = _get_session_val("password");

            $is_pass_changed = true;

            break;
        }
    }

    if ($is_pass_changed) {
        // Convert associative array to json string
        $json = json_encode($users);
        // Put all the json string to the file
        file_put_contents(_CONFIG["DB_DIR"], $json);
    }

    return $is_pass_changed;
}

function _verify_forget_password(&$messages, $email)
{
    // Get data from json
    $found_user = _get_user($email);

    if (!empty($found_user)) {
        // This will prevent direcly change password by url
        _set_session_val('forget_pass', true);
        _set_session_val('foget_pass_email', $found_user['email']);

        return true;
    }

    $messages["errors"][] = "Can not find the Email on Database";
    return false;
}

function _view_users($name = "", $email = "")
{
    // Get data from json
    $users = _get_users();
    $found_users = [];

    if (_get_session_val('email') == $email)
        return $found_users;

    if (empty($name) && empty($email)) {
        foreach ($users as $user) {

            if (_get_session_val('email') == $user['email']) {
                continue;
            }

            $found_users[] = $user;
        }

        return $found_users;
    }

    foreach ($users as $user) {

        if (!empty($name) && empty($email)) {
            if (preg_match("/" . $name . "/i", $user['name']) == 1) {
                $found_users[] = $user;
            }
        } else if (!empty($email) && empty($name)) {
            if ($email == $user['email']) {
                $found_users[] = $user;
            }
        } else if (!empty($email) && !empty($name)) {
            if (preg_match("/" . $name . "/i", $user['name']) == 1 && $email == $user['email']) {
                $found_users[] = $user;
            }
        }
    }

    return $found_users;
}

function _delete_user(&$messages, $email)
{
    // Get data from json
    $users = _get_users();
    $is_deleted = false;
    $flag = false;

    if (_get_session_val('email') == $email) {
        return $is_deleted;
    }

    if (!empty($email)) {
        for ($i = 0; $i < count($users); ++$i) {

            if ($users[$i]['email'] == $email) {
                $users[$i] = null;

                $is_deleted = true;
                $flag = true;

                break;
            }
        }
        array_multisort($users);
        array_shift($users);

        // _var_dump($users);

        if ($is_deleted) {
            // Convert associative array to json string
            $json = json_encode($users);
            // Put all the json string to the file
            file_put_contents(_CONFIG["DB_DIR"], $json);
        } else {
            $messages["errors"][] = "Can not find the Email on Database";
        }
    }

    return $is_deleted;
}

function _appointment_doctor(&$messages, $docemail)
{
    $is_appointed = false;
    $appointments = json_decode(file_get_contents(_ROOT_DIR . "model/appointments.json"), true);
    // _var_dump($appointments);

    if (!empty($appointments)) {
        foreach ($appointments as $appointment) {
            if ($appointment[0] == $docemail && $appointment[1] == _get_session_val('email')) {
                $messages["errors"][] = "Already Appointment request sended";
                return false;
            }
        }
    }

    $users = _get_users();

    foreach ($users as $user) {
        if ($user['utype'] == "doctor" && $user['email'] == $docemail) {
            $is_appointed = true;
        }
    }

    if ($is_appointed === true) {
        array_push($appointments, [$docemail, _get_session_val('email')]);

        // Convert associative array to json string
        $json = json_encode($appointments);
        // Put all the json string to the file
        file_put_contents(_ROOT_DIR . "model/appointments.json", $json);

        return true;
    } else {
        $messages["errors"][] = "Can not find the Doctor on Database";
        return false;
    }

    return false;
}

function _request_ambulance($reason)
{
    $ambulances = json_decode(file_get_contents(_ROOT_DIR . "model/ambulances.json"), true);

    if (empty($ambulances)) {
        $ambulances = [];
    }

    $ambulances[] = [_get_session_val('email') => $reason];

    // Convert associative array to json string
    $json = json_encode($ambulances);
    // Put all the json string to the file
    // file_put_contents(_ROOT_DIR . "model/ambulances.json", $json);

    return file_put_contents(_ROOT_DIR . "model/ambulances.json", $json);
}

function _view_appointments($patientemail = "")
{
    // Get data from json
    $appointments = json_decode(file_get_contents(_ROOT_DIR . "model/appointments.json"), true);
    $found_appointments = [];

    if (empty($patientemail)) {
        foreach ($appointments as $appointment) {
            if(_get_session_val('email') == $appointment[0]) {
                $found_appointments[] = $appointment[1];
            }
        }

        return $found_appointments;
    } else {
        foreach ($appointments as $appointment) {
            if(_get_session_val('email') == $appointment[0] && $appointment[1] == $patientemail) {
                $found_appointments[] = $appointment[1];
            }
        }
    }

    return $found_appointments;
}
