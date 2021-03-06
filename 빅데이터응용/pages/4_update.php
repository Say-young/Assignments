<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>Travel Essential Items</title>
        <link rel="stylesheet" href="../style/4.css">
    </head>
    <body>
        <header class = "header">
            <img id="header" src = "../img/4_white.png">
            <div class="stroke"></div>
            <div class="intro">Travel Essential Items</div>
            <div class="intro">What are the must-have items for traveling?</div>
        </header>

        <div class="title">
            <?php
                $mysqli = mysqli_connect("localhost", "team16", "team16", "team16");

                if(mysqli_connect_error()){
                    prinf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }else{
                    try{
                        $mysqli -> autocommit(FALSE);

                        $sql1 = "SELECT * FROM user WHERE user_name = '".$_POST['user_name']."' and user_password = '".$_POST['user_password']."'";
                        $res = mysqli_query($mysqli, $sql1);

                        if($res){
                            $num = mysqli_num_rows($res);
                            if($num == 1){
                                //계정 존재 - user_idx 반환
                                while($newArray = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                                    $idx = $newArray['user_idx'];
    
                                    $sql2 = "UPDATE `must_have_items` SET item_name = '".$_POST['user_item']."' WHERE user_idx = '".$idx."'";
                                    $update = mysqli_query($mysqli, $sql2);
    
                                    if($update === TRUE){
                                        echo("I used Transaction here. Your data is updated successfully.");
                                    }else{
                                        //업데이트 실패
                                    }
                                    $mysqli -> commit();
                                    $mysqli -> autocommit(TRUE);
                                }
                            }else{
                                //계정 정보 존재하지 않음.
                                echo("I used Transaction here. This Account does not exist.");
                            }
                        }else{
                            //sql1쿼리 정상 작동 안함
                        }
                    }catch(Exception $e){
                        $mysqli -> rollback();
                        $mysql -> autocommit(TRUE);
                    }

                    mysqli_close($mysqli);
                }
            ?>
        </div>
        <div class="fora"><a href="4.html" style="text-decoration:none">Back</a></div>
    </body>
</html>