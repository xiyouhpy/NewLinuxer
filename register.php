<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
    include_once("function.php");
    include_once("conn.php");
    include_once("filter.php");

    //$schoolnum = $_POST["schoolnum"];
    //$password = $_POST["password"];
    //$name = $_POST["name"];
    //$tel = $_POST["tel"];
    //$class = $_POST["class"];

    if(checkid($schoolnum,$password) == -1)
    {
        echo "<script> alert(\"实名验证失败！请输入正确的学号和教务系统密码。\"); history.go(-1); </script>";
        exit();
    }
    
    $result = mysql_query("SELECT * FROM profile WHERE schoolnum = '".$schoolnum."'");
    if($row = mysql_fetch_array($result))
    {
        echo "<script> alert(\"已存在您的报名数据！报名编号不变，仍为".$row["profileid"]."，其他旧数据已被覆盖。\"); history.go(-1); </script>";
        mysql_query("UPDATE profile SET name = '".$name."' , tel = '".$tel."', class = '".$class."' WHERE schoolnum = '".$schoolnum."'");
    }
    else
    {
        mysql_query("INSERT INTO profile (schoolnum, name, tel, class) VALUES ('".$schoolnum."' , '".$name."' , '".$tel."', '".$class."')");
        $result = mysql_query("SELECT profileid FROM profile WHERE schoolnum = '".$schoolnum."'");
        $row = mysql_fetch_array($result);
        echo "<script> alert(\"报名成功！您的报名编号为：".$row["profileid"]."，请牢记您的编号。\"); history.go(-1); </script>";
    }
?>
</html>
