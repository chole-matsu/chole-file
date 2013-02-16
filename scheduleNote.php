suche.php

<html>
<head>
        <style type=text/css>
        #dei,#iya,#manth{border:none;width:3em;border-bottom:1px solid #000;}
        #namae{background:#ccddaa;}
        #schedule_back{background:#ffccdd;}
    </style>
</head>
<body><center>
    <div id=namae>スケジュール登録</div>
<form action="suche.php" method="post">
<input type="text" id="iya" name="year">年
<input type="text" id="manth" name="month">月
<input type="text" id="dei" name="day">日
<input type="text" name="Title">タイトル<p>
内容:<p>
    <textarea name="body" cols=20 rows=10>ここに内容をいれてね</textarea><br>
    <input type="submit" name="regist" value="登録">
</form>



<?php
if(isset($_GET["del"])){
        $filename="samp.txt";
        $fp=fopen($filename,"w");
        $SClist=file($filename);
        foreach($SClist as $lineno => $original_line){
        if($_GET["del"] == $lineno){
        }else{
                fwrite($fp,$original_line);
        }

        }
        fclose($fp);
}

if(isset($_POST["regist"])){
        $error_message= array();
        if(isset($_POST["year"])&& is_numeric($_POST["year"]) && $_POST["year"] > 0 ){//年のチェック
                $year = $_POST["year"];
                }
        else{
                $error_message[]="年をちゃんと入力しろ！<br>";
        }

        if(isset($_POST["month"])&& is_numeric($_POST["month"]) && $_POST["month"] > 0 ){//月のチェック
                $month=$_POST["month"];
        }
        else{
                $error_message[]="月をちゃんと入力しろ！<br>";
        }

        if(isset($_POST["day"])&& is_numeric($_POST["day"]) && $_POST["day"] > 0 ){//日のチェック
                $day = $_POST["day"];
        }
        else{
                $error_message[]="日をちゃんと入力しろ！<br>";
        }

        if(isset($_POST["Title"]) &&  $_POST["Title"] ){
                $title = $_POST["Title"];
        }
        else{
                 $error_message[]="タイトルをちゃんと入力しろ！<br>";
        }

        if(isset($_POST["body"])&&  $_POST["body"] ){
                $body = $_POST["body"];
        }
        else{
                 $error_message[]="本文をちゃんと入力しろ！<br>";
        }


if(!count($error_message)){
$filename="/var/www/html/BBS/samp.txt";
$schedule_data=sprintf("%04d%02d%02d",$year,$month,$day);
$line = $schedule_data."|".$title."|".$body."\n";
$fp = fopen($filename,"a");
fwrite($fp,$line);
fclose($fp);
echo"登録が完了しました。";
}


//エラーメッセージの表示
if(count($error_message)){
        foreach($error_message as $message){
                print($message);
        }
}

}//if文(registの確認)の終わり
?>

<?php
$filename="samp.txt";
$SCdata=file($filename);

foreach($SCdata as $lineno => $line){
        $explode_result=explode("|",$line);
?>
<div id=schedule_back>

<?php        $SC=$explode_result[0];
        $title=$explode_result[1];
        $body=$explode_result[2];
        print("<p>日付:$SC<br> タイトル:$title<br> 内容：$body
<a href=\"suche.php?del=$lineno\">削除</a><br>");
?>
</div>
<?php
}
?>


</body>
</html>
