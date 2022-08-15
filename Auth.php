<?php

class Auth
{
    public function adminLogin()
    {    
         extract($_POST);
        // $email = $_POST['email'];
        // $password = $_POST['password'];
        $link = oci_connect('shofi', '123', 'localhost/orcl');
        $sql = "SELECT
        fkl,
        user_role,
        status,
        password,
        vempname,
        vdesignationname,
        vdepartmentname,
        empstatus
    FROM
        hrm_vw_employeeinfo hr
        inner JOIN useradmin usr ON hr.vemployeeid = usr.fkl
    WHERE
       usr.fkl = $fkl and usr.password='$password' and usr.status='1'";
        // $sql = "select * from user_admin where email = '$email' and password = '$password'";
        // $sql = "select * from useradmin where fkl=$fkl and password='$password' and status='1'";
        $query=oci_parse($link,$sql);
        if (oci_execute($query)) {
            $user = oci_fetch_assoc($query);
            oci_close($link);
            if (isset($user)) {
                $_SESSION['id'] = $user['ID'];               
                $_SESSION['fkl'] = $user['FKL'];               
                $_SESSION['user_role'] = $user['USER_ROLE'];
                $_SESSION['status'] = $user['STATUS'];
                $_SESSION['password'] = $user['PASSWORD'];
                $_SESSION['name'] = $user['VEMPNAME'];
                $_SESSION['vdesignationname'] = $user['VDESIGNATIONNAME'];
                $_SESSION['vdepartmentname'] = $user['VDEPARTMENTNAME'];
                header('location: index.php');

            } else {
                echo "No Connect";
                header('location:login.php');
            }
        } else {
            die('Fkl Id or Password not match');
        }
    }

    public function logout()
    {   
        unset($_SESSION['id']);
        unset($_SESSION['fkl']);
        unset($_SESSION['user_role']);
        unset($_SESSION['status']);
        unset($_SESSION['name']);
        unset($_SESSION['vdesignationname']);
        unset($_SESSION['vdepartmentname']);
        header('location: login.php');
    }
}
