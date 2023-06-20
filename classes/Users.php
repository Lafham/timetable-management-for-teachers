<?php

include 'lib/Database.php';
include_once 'lib/Session.php';


class Users
{


  // Db Property
  private $db;

  // Db __construct Method
  public function __construct()
  {
    $this->db = new Database();
  }

  // Date formate Method
  public function formatDate($date)
  {
    // date_default_timezone_set('Asia/Dhaka');
    $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
  }



  // Check Exist Email Address Method
  public function checkExistEmail($email)
  {
    $sql = "SELECT email from  tbl_users WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // Check Exist Email Address Method
  public function checkExistEmailEnseignant($Email)
  {
    $sql = "SELECT email from  enseignant WHERE Email = :Email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':Email', $Email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }



  // user Registration Method
  public function userRegistration($data)
  {
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } elseif ((!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO tbl_users(name, username, email, password, mobile, roleid) VALUES(:name, :username, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', ($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> You have Registered Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }
  // Add New User By Admin
  public function addNewUserByAdmin($data)
  {
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO tbl_users(name, username, email, password, mobile, roleid) VALUES(:name, :username, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', ($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='utilisateurs.php';</script>";
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Wow, you have Registered Successfully !</div>';
        return $msg;
      } else {
        echo "<script>location.href='utilisateurs.php';</script>";
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }



  // Select All User Method
  public function selectAllUserData()
  {
    $sql = "SELECT * FROM tbl_users ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // User login Autho Method
  public function userLoginAutho($email, $password)
  {
    $password = $password;
    $sql = "SELECT * FROM tbl_users WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Check User Account Satatus
  public function CheckActiveUser($email)
  {
    $sql = "SELECT * FROM tbl_users WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }




  // User Login Authotication Method
  public function userLoginAuthotication($data)
  {
    $email = $data['email'];
    $password = $data['password'];


    $checkEmail = $this->checkExistEmail($email);

    if ($email == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email or Password not be Empty !</div>';
      return $msg;
    } elseif ($checkEmail == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email did not Found, use Register email or password please !</div>';
      return $msg;
    } else {


      $logResult = $this->userLoginAutho($email, $password);
      $chkActive = $this->CheckActiveUser($email);

      if ($chkActive == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Sorry, Your account is Diactivated, Contact with Admin !</div>';
        return $msg;
      } elseif ($logResult) {

        Session::init();
        Session::set('login', TRUE);
        Session::set('id', $logResult->id);
        Session::set('roleid', $logResult->roleid);
        Session::set('name', $logResult->name);
        Session::set('email', $logResult->email);
        Session::set('username', $logResult->username);
        Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> You are Logged In Successfully !</div>');
        echo "<script>location.href='index.php';</script>";
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Email or Password did not Matched !</div>';
        return $msg;
      }
    }
  }



  // Get Single User Information By Email Method
  public function getUserInfoByEmail($userEmail)
  {
    $sql = "SELECT * FROM enseignant WHERE Email = :Email LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':Email', $userEmail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  //
  public function getFiliereInfo($id)
  {
    $sql = "SELECT * FROM filiere WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  //
  public function getModuleInfo($num)
  {
    $sql = "SELECT * FROM module WHERE num = :num LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':num', $num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }


  //
  public function getroleInfo($num)
  {
    $sql = "SELECT * FROM role_administratif WHERE num = :num LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':num', $num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  
  //
  public function getDepInfo($id)
  {
    $sql = "SELECT * FROM departement WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }
  // Get Single User Information By Id Method
  public function getUserInfoById($userid)
  {
    $sql = "SELECT * FROM tbl_users WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  //   Get Single User Profile Information By Id Method
  public function updateUserProfileByIdInfo($userid, $data)
  {
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];




    if ($name == "" || $username == "" || $email == "" || $mobile == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } elseif ((!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } else {

      $sql = "UPDATE tbl_users SET
      name = :name,
      username = :username,
      email = :email,
      mobile = :mobile
      WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();

      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }




  //   Get Single User Information By Id Method
  public function updateUserByIdInfo($userid, $data)
  {
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];



    if ($name == "" || $username == "" || $email == "" || $mobile == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } elseif ((!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } else {

      $sql = "UPDATE tbl_users SET
      name = :name,
      username = :username,
      email = :email,
      mobile = :mobile,
      roleid = :roleid
      WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();

      if ($result) {
        echo "<script>location.href='utilisateurs.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='utilisateurs.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }


  //   Get Single User Information By Email Method
  public function updateUserByEmailInfo($userEmail, $data)
  {
    $Nom_Complet = $data['Nom_Complet'];
    $Telephone = $data['Telephone'];
    $Civilite = $data['Civilite'];
    $Grade = $data['Grade'];
    $id_users = $data['id_users'];



    if ($Nom_Complet == "" || $Telephone == "" || $Civilite == "" || $Grade == "" || $id_users == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } elseif (filter_var($Telephone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } else {

      $sql = "UPDATE enseignant SET
          Nom_Complet = :Nom_Complet,
          Telephone = :Telephone,
          Civilite =:Civilite,
          Grade = :Grade,
          id_users = :id_users
          WHERE Email = :Email";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':Nom_Complet', $Nom_Complet);
      $stmt->bindValue(':Telephone', $Telephone);
      $stmt->bindValue(':Civilite', $Civilite);
      $stmt->bindValue(':Grade', $Grade);
      $stmt->bindValue(':id_users', $id_users);
      $stmt->bindValue(':Email', $userEmail);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='enseignant.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }

  // update Prof by email method
  public function updateEnseignantByEmailInfo($userEmail, $data)
  {
    $Nom_Complet = $data['Nom_Complet'];
    $Telephone = $data['Telephone'];
    $Civilite = $data['Civilite'];
    $Grade = $data['Grade'];


    if ($Nom_Complet == "" || $Telephone == "" || $Civilite == "" || $Grade == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } elseif (filter_var($Telephone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } else {

      $sql = "UPDATE enseignant SET
          Nom_Complet = :Nom_Complet,
          Telephone = :Telephone,
          Civilite =:Civilite,
          Grade = :Grade
          WHERE Email = :Email";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':Nom_Complet', $Nom_Complet);
      $stmt->bindValue(':Telephone', $Telephone);
      $stmt->bindValue(':Civilite', $Civilite);
      $stmt->bindValue(':Grade', $Grade);
      $stmt->bindValue(':Email', $userEmail);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='enseignant.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }



  // update Module by num method
  public function updateModuleByNum($num, $data)
  {
    $Nom_Module = $data['Nom'];
    $Filiere = $data['Filiere'];
    $Responsable = $data['Responsable'];


    if ($Nom_Module == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "UPDATE module SET
          Nom_Module = :Nom_Module,
          Filiere = :Filiere,
          Responsable =:Responsable
          WHERE num = $num";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':Filiere', $Filiere);
      $stmt->bindValue(':Responsable', $Responsable);
      $stmt->bindValue(':Nom_Module', $Nom_Module);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='ConsulterModules.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterModules.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }

  // update Filiere by name method
  public function updateFiliereById($id, $data)
  {
    $Nom_filiere = $data['Nom'];
    $TypeFormation = $data['TypeFormation'];
    $Description = $data['Description'];
    $Responsable = $data['Responsable'];


    if ($Nom_filiere == "" || $TypeFormation == "" || $Description == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "UPDATE filiere SET
          Nom_filiere = :Nom_filiere,
          Type_de_formation = :Type_de_formation,
          Responsable =:Responsable,
          Description = :Description
          WHERE id = $id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':Type_de_formation', $TypeFormation);
      $stmt->bindValue(':Responsable', $Responsable);
      $stmt->bindValue(':Description', $Description);
      $stmt->bindValue(':Nom_filiere', $Nom_filiere);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='ConsulterFilieres.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterFilieres.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }
  // update Role by num method
  public function updateroleBynum($num, $data)
  {
    $Prof = $data['Prof'];
    $role = $data['role'];
    $nombre = $data['nombre'];

    if ($role == "" || $nombre == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Error !</strong> Fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "UPDATE role_administratif SET
         professeur = :Prof,
         role =:role,
         nombre_heure = :nombre
         WHERE num = $num";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':Prof', $Prof);
      $stmt->bindValue(':role', $role);
      $stmt->bindValue(':nombre', $nombre);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='ConsulterRole.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterRole.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }

  // update Filiere by name method
  public function updateDepById($id, $data)
  {
    $nom_departement = $data['Nom'];
    $responsable = $data['Responsable'];


    if ($nom_departement == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "UPDATE departement SET
          nom_departement = :nom_departement,
          responsable =:responsable
          WHERE id = $id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':nom_departement', $nom_departement);
      $stmt->bindValue(':responsable', $responsable);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='ConsulterDep.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterDep.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }


  // Delete User by Id Method
  public function deleteUserById($remove)
  {

    $sql = "DELETE FROM tbl_users WHERE id = :id limit 1 ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not Deleted !</div>');
    }
  }
  //  Delete Prof by Num Module Method
  public function deleteUserByNumeroModule($Num, $Prof, $type)
  {


    $sql = "DELETE FROM enseigner WHERE Num_Module = :num AND Professeur ='$Prof' limit 1 ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':num', $Num);

    $result = $stmt->execute();

    $sql1 = "DELETE FROM assurer WHERE Num_Module = :num AND Prof='$Prof' limit 1 ";
    $stmt1 = $this->db->pdo->prepare($sql1);
    $stmt1->bindValue(':num', $Num);
    $result = $stmt1->execute();

    $sql5 = "DELETE FROM assurertype WHERE num_type = :type limit 1 ";
    $stmt5 = $this->db->pdo->prepare($sql5);
    $stmt5->bindValue(':type', $type);
    $result = $stmt5->execute();

    $sql3 = "DELETE FROM contenir WHERE Num_Module=:num AND Num_Type = :type limit 1 ";
    $stmt3 = $this->db->pdo->prepare($sql3);
    $stmt3->bindValue(':num', $Num);
    $stmt3->bindValue(':type', $type);
    $result = $stmt3->execute();


    if ($result) {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not Deleted !</div>');
    }
  }

  // Delete Prof by Email Method
  public function deleteProfByEmail($userEmail)
  {
    $sql = "DELETE FROM enseignant WHERE Email = :Email ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':Email', $userEmail);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='enseignant.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='enseignant.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not Deleted !</div>');
    }
  }

  // Delete Module by Numero Method
  public function deleteModuleByNum($num)
  {
    $sql = "DELETE FROM module WHERE num = :num ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='ConsulterModules.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='ConsulterModules.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Data not Deleted !</div>');
    }
  }
  // Delete Dep by id Method
  // public function deleteDepById($id)
  // {
  //   $sql = "DELETE FROM departement WHERE id = :id ";
  //   $stmt = $this->db->pdo->prepare($sql);
  //   $stmt->bindParam(':id', $id);
  //   $result = $stmt->execute();
  //   if ($result) {
  //     echo "<script>location.href='ConsulterModules.php';</script>";
  //     Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //     <strong>Success !</strong> Deleted Successfully !</div>');
  //   } else {
  //     echo "<script>location.href='ConsulterModules.php';</script>";
  //     Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //     <strong>Error !</strong> Data not Deleted !</div>');
  //   }
  // }

  // Delete Role by Numero Method
  public function deleteRoleByNum($num)
  {
    $sql = "DELETE FROM role_administratif WHERE num = :num ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='Consulterrole.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='Consulterrole.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Data not Deleted !</div>');
    }
  }

  // Delete Filiere by Numero Method
  public function deleteFiliereById($id)
  {
    $sql = "DELETE FROM filiere WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='ConsulterFilieres.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Deleted Successfully !</div>');
    } else {
      echo "<script>location.href='ConsulterFilieres.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Data not Deleted !</div>');
    }
  }



  // User Deactivated By Admin
  public function userDesactiveByAdmin($deactive)
  {
    $sql = "UPDATE tbl_users SET

       isActive=:isActive
       WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account Disactivated Successfully !</div>');
    } else {
      echo "<script>location.href='utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not Disactivated !</div>');

      // return $msg;
    }
  }


  // User Deactivated By Admin
  public function userActiveByAdmin($active)
  {
    $sql = "UPDATE tbl_users SET
       isActive=:isActive
       WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='Utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account activated Successfully !</div>');
    } else {
      echo "<script>location.href='Utilisateurs.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not activated !</div>');
    }
  }




  // Check Old password method
  public function CheckOldPassword($userid, $old_pass)
  {
    $sql = "SELECT password FROM tbl_users WHERE password = :password AND id =:id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':password', $old_pass);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }



  // Change User pass By Id
  public  function changePasswordBysingelUserId($userid, $data)
  {

    $old_pass = $data['old_password'];
    $new_pass = $data['new_password'];


    if ($old_pass == "" || $new_pass == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Password field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($new_pass) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> New password must be at least 6 character !</div>';
      return $msg;
    }

    $oldPass = $this->CheckOldPassword($userid, $old_pass);
    if ($oldPass == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error !</strong> Old password did not Matched !</div>';
      return $msg;
    } else {
      $new_pass = ($new_pass);
      $sql = "UPDATE tbl_users SET

            password=:password
            WHERE id = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $new_pass);
      $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();

      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Great news, Password Changed successfully !</div>');
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Password did not changed !</div>';
        return $msg;
      }
    }
  }


  // selecter les roles des profs
  public function selectRole()
  {
    $sql = "SELECT * FROM role_administratif ORDER BY num ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // selecter le respo de departement
  public function selectDep()
  {
    $sql = "SELECT * FROM departement ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // selecter tous professeurs
  public function selectEnseignant()
  {
    $sql = "SELECT * FROM enseignant ORDER BY Email ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // selecter tous les modules
  public function selectModule()
  {
    $sql = "SELECT num,Nom_Module, Nom_filiere,m.Responsable FROM module m
    JOIN filiere ON Filiere=id ORDER BY num ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // selecter tous les filieres
  public function selectFiliere()
  {
    $sql = "SELECT * FROM filiere ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Remplir la charge horaire
  public function Remplissage()
  {
    $sql = "SELECT en.Email,en.Nom_Complet , en.Grade, m.num, m.Nom_Module, f.Nom_filiere, s.Nom_Semestre,
     s.Nom_Session,c.Nombre_Heure_Cours,c.Nombre_Heure_TD,c.Nombre_Heure_TP,c.Num_Type ,tb.id
    FROM tbl_users tb 
    JOIN enseignant en ON tb.id=en.id_users
    JOIN enseigner er ON en.Email=er.Professeur
    JOIN module m ON er.Num_Module = m.num 
    JOIN filiere f ON m.Filiere = f.id
    JOIN assurer a ON en.Email=a.Prof and m.num=a.Num_Module
    JOIN semestre s ON a.Nom_Semestre = s.Nom_Semestre
    JOIN assurertype ss ON en.Email = ss.Prof
    JOIN type_enseignement t ON ss.num_type = t.numero
    JOIN contenir c ON t.numero = c.Num_Type WHERE er.Num_Module = c.Num_Module";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // }

  public function AjouterEnseignant($data)
  {
    $Nom_Complet = $data['Nom_Complet'];
    $Email = $data['Email'];
    $Telephone = $data['Telephone'];
    $Civilite = $data['Civilite'];
    $Grade = $data['Grade'];
    $users = $data['users'];


    $checkEmail = $this->checkExistEmailEnseignant($Email);

    if ($Nom_Complet == "" ||  $Email == "" || $Telephone == "" || $users == "" || $Civilite == "" || $Grade == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } elseif (filter_var($Telephone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO `enseignant`(`Nom_Complet`, `Email`, `Telephone`, `Civilite`, `Grade`,`id_users`) VALUES (:Nom_Complet,:Email,:Telephone,:Civilite,:Grade,:id_users)";
      $stmt = $this->db->pdo->prepare($sql);
      $result = $stmt->execute(array(":Nom_Complet" => $Nom_Complet, ":Email" => $Email, ":Telephone" => $Telephone, ":Civilite" => $Civilite, ":Grade" => $Grade, ":id_users" => $users));
      if ($result) {
        echo "<script>location.href='enseignant.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='enseignant.php';</script>";
        echo "<script>location.href='enseignant.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }


  //   Get Single User Information By Id Method
  public function updateChargeByProfEmail($ProfEmail, $moduleType, $numModule, $data)
  {
    $Num_Module = $data['Nom_Module'];
    $Nom_Semestre = $data['Nom_Semestre'];
    $Nombre_Heure_Cours = $data['Nombre_Heure_Cours'];
    $Nombre_Heure_TD = $data['Nombre_Heure_TD'];
    $Nombre_Heure_TP = $data['Nombre_Heure_TP'];

    if ($Num_Module == "" || $Nom_Semestre == "" || $Nombre_Heure_Cours == "" || $Nombre_Heure_TD == "" || $Nombre_Heure_TP == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql2 = "UPDATE enseigner SET
      Num_Module = :Num_Module 
      WHERE  Professeur = '$ProfEmail' 
      AND Num_Module = $numModule ";
      $stmt2 = $this->db->pdo->prepare($sql2);
      $stmt2->bindValue(':Num_Module', $Num_Module);
      $result2 = $stmt2->execute();

      $sql1 = "UPDATE contenir SET
      Num_Module = :Num_Module,
      Nombre_Heure_Cours = :Nombre_Heure_Cours,
      Nombre_Heure_TD = :Nombre_Heure_TD,
      Nombre_Heure_TP = :Nombre_Heure_TP
      WHERE Num_Module = $numModule
      AND Num_Type = $moduleType ";
      $stmt1 = $this->db->pdo->prepare($sql1);
      $stmt1->bindValue(':Num_Module', $Num_Module);
      $stmt1->bindValue(':Nombre_Heure_Cours', $Nombre_Heure_Cours);
      $stmt1->bindValue(':Nombre_Heure_TD', $Nombre_Heure_TD);
      $stmt1->bindValue(':Nombre_Heure_TP', $Nombre_Heure_TP);
      $result1 =  $stmt1->execute();


      $sql3 = "UPDATE assurer SET
      Num_Module = :NumModule,
      Nom_Semestre = :NomSemestre
       WHERE Num_Module = $numModule
       AND Prof = '$ProfEmail' ";
      $stmt3 = $this->db->pdo->prepare($sql3);
      $stmt3->bindValue(':NumModule', $Num_Module);
      $stmt3->bindValue(':NomSemestre', $Nom_Semestre);
      $result3 = $stmt3->execute();



      if ($result1 && $result2 && $result3) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }

  // Get Single User Information By Email Method
  public function getChargeInfoByProfEmail($ProfEmail)
  {
    $sql = "SELECT en.Nom_Complet , en.Grade, m.Nom_Module, f.Nom_filiere, s.Nom_Semestre, s.Nom_Session,c.Nombre_Heure_Cours,c.Nombre_Heure_TD,c.Nombre_Heure_TP,c.Num_Type,en.id_users 
      FROM enseignant en
      JOIN enseigner er ON en.Email=er.Professeur
      JOIN module m ON er.Num_Module = m.num 
      JOIN filiere f ON f.id=m.Filiere
      JOIN assurer a ON en.Email=a.Prof and m.num=a.Num_Module
      JOIN semestre s ON a.Nom_Semestre = s.Nom_Semestre
      JOIN assurertype ss ON en.Email = ss.Prof
      JOIN type_enseignement t ON ss.num_type = t.numero
      JOIN contenir c ON t.numero = c.Num_Type WHERE er.Num_Module = c.Num_Module
      AND Email = :ProfEmail LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':ProfEmail', $ProfEmail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  public function selectGrade()
  {
    $sql = "SELECT Grade FROM grade ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectUsername()
  {
    $sql = "SELECT id,username  FROM tbl_users ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectEnseignantEmail()
  {
    $sql = "SELECT Email,Nom_Complet FROM enseignant ORDER BY Email DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectModuleName()
  {
    $sql = "SELECT num,Nom_Module FROM module  ORDER BY num DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectFiliereName()
  {
    $sql = "SELECT id,Nom_filiere FROM filiere ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectSemestreName()
  {
    $sql = "SELECT Nom_Semestre FROM semestre ORDER BY Nom_Semestre DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectSessionName()
  {
    $sql = "SELECT Nom_Session FROM _session ORDER BY Nom_Session DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectAllTypeEnseignement()
  {
    $sql = "SELECT numero,label FROM type_enseignement ORDER BY numero ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectGradeName()
  {
    $sql = "SELECT Grade FROM grade ORDER BY Grade DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // public function AddChargeHoraire($data)
  // {
  //   $Professeur = $data['Professeur'];
  //   $Module = $data['Module'];;
  //   $Semestre = $data['Semestre'];
  //   $type = $data['type'];
  //   $Nombre_Heure_Cours = $data['Nombre_Heure_Cours'];
  //   $Nombre_Heure_TD = $data['Nombre_Heure_TD'];
  //   $Nombre_Heure_TP = $data['Nombre_Heure_TP'];

  //   $checkNumModule = $this->checkExistTypeEnseignementNumModule($Module, $type);

  //   if ($Nombre_Heure_Cours == "" || $Nombre_Heure_TD == "" || $Nombre_Heure_TP == "") {
  //     $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //     <strong>Error !</strong> Please, field must not be Empty !</div>';
  //     return $msg;
  //   } else {


  //     $sql = "INSERT INTO `enseigner`(`Professeur`,`Num_Module`) VALUES (:Professeur,:Num_Module)";
  //     $stmt = $this->db->pdo->prepare($sql);
  //     $result = $stmt->execute(array(":Professeur" => $Professeur, ":Num_Module" => $Module));

  //     $sql1 = "INSERT INTO `assurer`(`Prof`,`Num_Module`,`Nom_Semestre`) VALUES (:Prof,:Num_Module,:Nom_Semestre)";
  //     $stmt1 = $this->db->pdo->prepare($sql1);
  //     $result1 = $stmt1->execute(array(":Prof" => $Professeur, ":Num_Module" => $Module, ":Nom_Semestre" => $Semestre));

  //     $sql3 = "INSERT INTO `assurertype`(`Prof`,`num_type`) VALUES (:Prof,:num_type)";
  //     $stmt3 = $this->db->pdo->prepare($sql3);
  //     $result3 = $stmt3->execute(array(":Prof" => $Professeur, ":num_type" => $type));

  //     if ($checkNumModule == TRUE) {
  //       $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  //       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //       <strong>Error !</strong> Ce type d\'enseignement est deja affecté à ce module .. Ressayer.. !</div>';
  //       return $msg;
  //     } else {
  //       $sql4 = "INSERT INTO `contenir`(`Num_Module`,`num_type`,`Nombre_Heure_Cours`,`Nombre_Heure_TD`,`Nombre_Heure_TP`) VALUES 
  //     (:Num_Module,:num_type,:Nombre_Heure_Cours,:Nombre_Heure_TD,:Nombre_Heure_TP)";
  //       $stmt4 = $this->db->pdo->prepare($sql4);
  //       $result4 = $stmt4->execute(array(":Num_Module" => $Module, ":num_type" => $type, ":Nombre_Heure_Cours" => $Nombre_Heure_Cours, ":Nombre_Heure_TD" => $Nombre_Heure_TD, ":Nombre_Heure_TP" => $Nombre_Heure_TP));
  //     }

  //     if ($result && $result1  && $result3 && $result4) {
  //       echo "<script>location.href='index.php';</script>";
  //       Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  //       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //       <strong>Success !</strong> Added successfully !</div>');
  //     } else {
  //       echo "<script>location.href='index.php';</script>";
  //       Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  //       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //       <strong>Success !</strong>Semething Went Wrong !!</div>');
  //     }
  //   }
  // }




  public function addModule($data)
  {
    $Nom_Module = $data['Nom_Module'];
    $Nom_Filiere = $data['Nom_Filiere'];
    $Responsable = $data['Responsable'];


    if ($Nom_Module == "" || $Nom_Filiere == "" || $Responsable == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO `module`(`Nom_Module`, `Filiere`, `Responsable`) VALUES (:Nom_Module,:Nom_Filiere,:Responsable)";
      $stmt = $this->db->pdo->prepare($sql);
      $result = $stmt->execute(array(":Nom_Module" => $Nom_Module, ":Nom_Filiere" => $Nom_Filiere, ":Responsable" => $Responsable));
      if ($result) {
        echo "<script>location.href='ConsulterModules.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterModules.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }



  public function addFiliere($data)
  {
    $Nom = $data['Nom'];
    $Type_de_formation = $data['Type_de_formation'];
    $Description = $data['Description'];
    $Email = $data['Email'];


    if ($Nom == "" ||  $Type_de_formation == "" || $Description == "" || $Email == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO `filiere`(`Nom_filiere`, `Type_de_formation`, `Description`, `Responsable`) VALUES (:Nom,:Type_de_formation,:Description,:Email)";
      $stmt = $this->db->pdo->prepare($sql);
      $result = $stmt->execute(array(":Nom" => $Nom, ":Type_de_formation" => $Type_de_formation, ":Description" => $Description, ":Email" => $Email));
      if ($result) {
        echo "<script>location.href='ConsulterFilieres.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterFilieres.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }


  // add a responsable of departement
  public function addResponsable($data)
  {
    $Nom = $data['Nom'];
    $Responsable = $data['Responsable'];


    if ($Nom == "" || $Responsable == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO `departement`(`nom_departement`, `responsable`) VALUES (:Nom,:Responsable)";
      $stmt = $this->db->pdo->prepare($sql);
      $result = $stmt->execute(array(":Nom" => $Nom, ":Responsable" => $Responsable));
      if ($result) {
        echo "<script>location.href='ajout.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='ajout.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }

  // add a administration role 
  public function addRole($data)
  {
    $role = $data['role'];
    $nombre = $data['nombre'];
    $Professeur = $data['Professeur'];


    if ($role == "" || $nombre == "" || $Professeur == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Please, field must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO `role_administratif`( `role`, `nombre_heure`, `professeur`) VALUES (:role,:nombre,:Professeur)";
      $stmt = $this->db->pdo->prepare($sql);
      $result = $stmt->execute(array(":role" => $role, ":nombre" => $nombre, ":Professeur" => $Professeur));
      if ($result) {
        echo "<script>location.href='ConsulterRole.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='ConsulterRole.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }
  // Verifier l'enseignant et son type d'enseignement
  public function checkExistTypeEnseignement($prof, $type)
  {
    $sql = "SELECT Prof,num_type from  assurertype WHERE num_type = :type AND Prof=:Prof";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':Prof', $prof);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function checkExistTypeEnseignementNumModule($num, $type)
  {
    $sql = "SELECT Num_Module,Num_Type from  contenir WHERE Num_Type = :type AND Num_Module=:num";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':num', $num);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function checkExistProfAndNumModule($Prof, $num)
  {
    $sql = "SELECT Num_Module,Professeur from  enseigner WHERE Professeur = :Prof AND Num_Module=:num";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':Prof', $Prof);
    $stmt->bindValue(':num', $num);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // ajouter des modules a l'enseignant
  public function AddModuleChargeHoraire($data)
  {
    $Professeur = $data['Professeur'];
    $Semestre = $data['Semestre'];
    $NumModule = $data['Module'];
    $type = $data['type'];
    $Nombre_Heure_Cours = $data['Nombre_Heure_Cours'];
    $Nombre_Heure_TD = $data['Nombre_Heure_TD'];
    $Nombre_Heure_TP = $data['Nombre_Heure_TP'];

    $checktype = $this->checkExistTypeEnseignement($Professeur, $type);
    $checkNumModule = $this->checkExistTypeEnseignementNumModule($NumModule, $type);
    $checkProf = $this->checkExistProfAndNumModule($Professeur, $NumModule);

    if ($Nombre_Heure_Cours == "" || $Nombre_Heure_TD == "" || $Nombre_Heure_TP == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Please,  field must not be Empty !</div>';
      return $msg;
    } else {
      if ($checkProf == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Ce Professeur a deja ce module.. Ressayer.. !</div>';
        return $msg;
      } else {
        $sql = "INSERT INTO `enseigner`(`Professeur`, `Num_Module`) VALUES (:Prof , :num)";
        $stmt = $this->db->pdo->prepare($sql);
        $result = $stmt->execute(array(":Prof" => $Professeur, ":num" => $NumModule));
      }


      if (!$result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      } else {
        if ($checktype == TRUE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Ce type d\'enseignement est deja affecté à cet enseignant .. Ressayer.. !</div>';
          return $msg;
        } else {
          $sql3 = "INSERT INTO `assurertype`(`Prof`, `num_type`)
          VALUES (:Prof, :num_type)";
          $stmt3 = $this->db->pdo->prepare($sql3);
          $result3 = $stmt3->execute(array(":Prof" => $Professeur, ":num_type" => $type));
        }
        if (!$result3) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
        } else {
          if ($checkNumModule == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Ce type d\'enseignement est deja affecté à ce module .. Ressayer.. !</div>';
            return $msg;
          } else {

            $sql2 = "INSERT INTO `contenir`(`Num_Module`, `Num_Type`, `Nombre_Heure_Cours`, `Nombre_Heure_TD`, `Nombre_Heure_TP`) 
          VALUES (:num,:numtype,:nbrHeureCours,:nbrHeureTD,:nbrHeureTP) ";
            $stmt2 = $this->db->pdo->prepare($sql2);
            $result2 = $stmt2->execute(array(":num" => $NumModule, ":numtype" => $type, ":nbrHeureCours" => $Nombre_Heure_Cours, ":nbrHeureTD" => $Nombre_Heure_TD, ":nbrHeureTP" => $Nombre_Heure_TP));

            $sql1 = "INSERT INTO `assurer`(`Prof`, `Num_Module`, `Nom_Semestre`)
          VALUES (:Prof , :num , :nom_semestre) ";
            $stmt1 = $this->db->pdo->prepare($sql1);
            $result1 = $stmt1->execute(array(":Prof" => $Professeur, ":num" => $NumModule, ":nom_semestre" => $Semestre));
          }
        }
      }

      if ($result && $result1 && $result2 && $result3) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Added successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong>Semething Went Wrong !!</div>');
      }
    }
  }
}
