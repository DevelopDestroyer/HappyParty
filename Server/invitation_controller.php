<?php

  /*
   *    DB 접속정보
   */
  include '../db_info.php';
  $DBHost = getDBHost();
  $DBUser = getDBUser();
  $DBPW = getDBPW();
  $DBName = getDBName();

  $connect = mysql_connect($DBHost,$DBUser,$DBPW);
  $db = mysql_select_db($DBName, $connect);
  $sql = "set names utf8";
  $result = mysql_query($sql, $connect);

  /*
   *    각 필드별 최대 사이즈 규격 정의 =
   */
  $MAX_LENGTH_SIZE_invitation_id = 64;
  $MAX_LENGTH_SIZE_password = 32;
  $MAX_LENGTH_SIZE_name = 32;
  $MAX_LENGTH_SIZE_subject = 256;
  $MAX_LENGTH_SIZE_contents = 5000;
  $MAX_LENGTH_SIZE_date_regist = 32;
  $MAX_LENGTH_SIZE_date_start = 32;
  $MAX_LENGTH_SIZE_date_end = 32;
  $MAX_LENGTH_SIZE_image = 5;
  $MAX_LENGTH_SIZE_font_color = 10;
  $MAX_LENGTH_SIZE_status = 5;

/*
  $sql = "select * from cvs_update_check where cvs_name='cu' and upload_date='".$today."'";
  $result = mysql_query($sql, $connect);

  while($row = mysql_fetch_row($result)){
    $isHaveItem = true;

  }
*/


  //echo $DBHost;


  /*
  *
  * CREATE
  *
  */
  if($_GET['order'] == "create"){

    //정규표현식
    if(0 == preg_match('/^[A-Za-z0-9+]*$/', $_POST['invitation_id'])){
      echo "{result:\"error\", code: \"4000\", msg:\"정규표현식 에러\"}";
      return;
    }
    //길이 검증
    if(
      $MAX_LENGTH_SIZE_invitation_id < mb_strlen($_POST['invitation_id'], "UTF-8") ||
      $MAX_LENGTH_SIZE_password < mb_strlen($_POST['password'], "UTF-8") ||
      $MAX_LENGTH_SIZE_name < mb_strlen($_POST['name'], "UTF-8") ||
      $MAX_LENGTH_SIZE_subject < mb_strlen($_POST['subject'], "UTF-8") ||
      $MAX_LENGTH_SIZE_contents < mb_strlen($_POST['contents'], "UTF-8") ||
      $MAX_LENGTH_SIZE_date_regist < mb_strlen($_POST['date_regist'], "UTF-8") ||
      $MAX_LENGTH_SIZE_date_start < mb_strlen($_POST['date_start'], "UTF-8") ||
      $MAX_LENGTH_SIZE_date_end < mb_strlen($_POST['date_end'], "UTF-8") ||
      $MAX_LENGTH_SIZE_image < mb_strlen($_POST['image'], "UTF-8") ||
      $MAX_LENGTH_SIZE_font_color < mb_strlen($_POST['font_color'], "UTF-8") ||
      $MAX_LENGTH_SIZE_status < mb_strlen($_POST['status'], "UTF-8")
    ){
      echo "{result:\"error\", code: \"4001\", msg:\"필드길이 에러\"}";
      return;
    }
    //mysql_real_escape_string();
    $sql = "INSERT INTO HP_INVITATION VALUES ('".$_POST['invitation_id']."', '".$_POST['password']."', '".$_POST['name']."', '".$_POST['subject']."', '".$_POST['contents']."', '".$_POST['date_regist']."', '".$_POST['date_start']."', '".$_POST['date_end']."', '".$_POST['image']."', '".$_POST['font_color']."', '".$_POST['status']."')";
    $result = mysql_query($sql, $connect);
    echo "{result:\"success\", code: \"200\", msg:\"입력 완료\"}";
/*
    while($row = mysql_fetch_row($result)){
      $isHaveItem = true;

    }
*/
  }
  /*
  *
  * CREATE - END
  *
  */

?>
