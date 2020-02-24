<?php
    include 'config.php';
    include 'util.php';

    $base = './corp_images/';
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $corp_id = $_POST['corp_id'];
    $corp_desc = $_POST['corp_desc'];
    $det = $_POST['content'];
    $busi_num = $_POST['busi_num'];
    $busi_name = $_POST['busi_name'];
    $busi_type = $_POST['kind'];
    $bank_name = $_POST['bank_name'];
    $bank_account = $_POST['bank_account'];
    $bank_owner = $_POST['bank_owner'];
    $logo = $_POST['filename'];
    $busi_certi = $_POST['filename2'];
    $account_pic = $_POST['filename3'];
    $manage_name = $_POST['manage_name'];
    $manage_dept = $_POST['manage_dept'];
    $manage_call = $_POST['manage_call'];
    $manage_email = $_POST['manage_email'];
    $files = [];

    $query = "select * from corp_info where corp_id ='$corp_id'";
    $ret = mysqli_query($conn, $query);
    $corp = mysqli_fetch_array($ret);
    $origin = [$corp['logo'], $corp['busi_certi'], $corp['account_pic']];
    $new = [$logo, $busi_certi, $account_pic];
    $a = explode('.', $logo);
    $b = explode('.', $busi_certi);
    $c = explode('.', $account_pic);
    $names = ['logo' . '.' . $a[1], 'busi_certi' . '.' . $b[1], 'account_pic' . '.' . $c[1]];
    mysqli_query($conn, "delete from corp_info where corp_id = '$corp_id'");
    if ($_FILES) {
        foreach ($_FILES['File']['name'] as $f => $name) {
            $name = $names[$f];
            if ($new[$f] != $origin[$f]) {
                $newname = $busi_name . $name;
                $uploadfile = $base . $newname;
                $files[$f] = $newname;
                unlink("corp_images/$origin[$f]");
                move_uploaded_file($_FILES['File']['tmp_name'][$f], $uploadfile);
            } else {
                $files[$f] = $origin[$f];
            }
        }

        $logo = $files[0];
        $busi_certi = $files[1];
        $account_pic = $files[2];
    }

   $query = "insert into corp_info values('$corp_id','$corp_desc','$det','$logo','$busi_num','$busi_name','$busi_type','$bank_name','$bank_account','$bank_owner','$busi_certi','$account_pic','$manage_name','$manage_dept','$manage_call','$manage_email')";
   if (mysqli_query($conn, $query)) {
       msg('저장 되었습니다.');
       echo '<script>location.href="profile_corp.php"</script>';
   } else {
       msg('오류입니다. 반복되면 고객센터로 직접 문의주세요');
   }
