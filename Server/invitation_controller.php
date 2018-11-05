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
    $sql = "INSERT INTO HP_INVITATION VALUES ('".mysql_real_escape_string($_POST['invitation_id'])."', '".mysql_real_escape_string($_POST['password'])."', '".mysql_real_escape_string($_POST['name'])."', '".mysql_real_escape_string($_POST['subject'])."', '".mysql_real_escape_string($_POST['contents'])."', '".mysql_real_escape_string($_POST['date_regist'])."', '".mysql_real_escape_string($_POST['date_start'])."', '".mysql_real_escape_string($_POST['date_end'])."', '".mysql_real_escape_string($_POST['image'])."', '".mysql_real_escape_string($_POST['font_color'])."', '".mysql_real_escape_string($_POST['status'])."')";
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
  
  
  else if($_GET['order'] == "modify"){
	  $isExistItem = false;
	  $invitation_id_from_DB = null;
	  $invitation_pw_from_DB = null;
	  //초대장 암호 대조
      $sql = "SELECT * FROM HP_INVITATION WHERE invitation_id = '".mysql_real_escape_string($_POST['invitation_id'])."'";
	  //('".mysql_real_escape_string($_POST['invitation_id'])."', '".mysql_real_escape_string($_POST['password'])."', '".mysql_real_escape_string($_POST['name'])."', '".mysql_real_escape_string($_POST['subject'])."', '".mysql_real_escape_string($_POST['contents'])."', '".mysql_real_escape_string($_POST['date_regist'])."', '".mysql_real_escape_string($_POST['date_start'])."', '".mysql_real_escape_string($_POST['date_end'])."', '".mysql_real_escape_string($_POST['image'])."', '".mysql_real_escape_string($_POST['font_color'])."', '".mysql_real_escape_string($_POST['status'])."')";
	  $result = mysql_query($sql, $connect);
	  
	  while($row = mysql_fetch_row($result)){
		$isExistItem = true;
		$invitation_id_from_DB = $row[0];
		$invitation_pw_from_DB = $row[1];
	  }
	  
	  if($isExistItem == false){
		  echo "{result:\"error\", code: \"4002\", msg:\"유효하지 않은 초대장 주소 입니다.\"}";
		  return;
	  }
	  
	  if($_POST['invitation_id'] != $invitation_id_from_DB || $_POST['password'] != $invitation_pw_from_DB){
		  echo "{result:\"error\", code: \"4003\", msg:\"초대장 주소 또는 암호가 잘못 되었습니다.\"}";
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

	  $sql = "UPDATE HP_INVITATION SET name = '".mysql_real_escape_string($_POST['name'])."', subject = '".mysql_real_escape_string($_POST['subject'])."', contents = '".mysql_real_escape_string($_POST['contents'])."', date_start = '".mysql_real_escape_string($_POST['date_start'])."',  date_end = '".mysql_real_escape_string($_POST['date_end'])."', font_color = '".mysql_real_escape_string($_POST['font_color'])."', status = '".mysql_real_escape_string($_POST['status'])."'";
	  $result = mysql_query($sql, $connect);
	  echo "{result:\"success\", code: \"200\", msg:\"수정 완료\"}";	  
	

  }

?>
