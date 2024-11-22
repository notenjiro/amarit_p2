<?php
function date_thai_to_utc($date){
    $dd = explode("/",$date);
    $y = (int)$dd[2]-543;
    return $y."-".$dd[1]."-".$dd[0];
}

function date_utc_to_thai($date){
    return date('d/m/Y',strtotime("+543 year",strtotime(date_format($date, 'Y-m-d'))));
}

function to_day_thai(){
    $y = date('Y') + 543;
    return date('d/m/').$y;
}

function member_type($type){
    switch ($type) {
        case 1: return "สามัญ";
        case 2: return "วิสามัญ";
    }
}

function bit_value($val){
    return $val?'Y':'N';
}

function null_decimal($val){
    if(is_null($val) || $val == "")
        return "NULL";
    else
        return "'$val'";
}

function null_val($val){
    if(is_null($val) || $val == "")
        return "NULL";
    else
        return "'$val'";
}


function userlogs($val,$conn){
    $user_name = $_SESSION["user_name"];
    $time = date('H:i:s', time() + 5 * 60 * 60);//date("h:i:s");
    $date = date("Y-m-d");
    $iquery = "INSERT INTO user_log (user_name, time, date, action_type,description) VALUES ('$user_name', '$time','$date','$val','')";

    $stmt = sqlsrv_query($conn, $iquery);
}

function full_date_thai($date){
    $doc_d = date_format($date,'d');
    $doc_m = date_format($date,'m');
    $doc_y = date_format($date,'Y');
    return $doc_d."-".month_thai_short($doc_m)."-".$doc_y;
}

function month_thai($month){
    switch ($month) {
        case "01":
            return "มกราคม";
            break;
        case "02":
            return "กุมภาพันธ์";
            break;
        case "03":
            return "มีนาคม";
            break;
        case "04":
            return "เมษายน";
            break;
        case "05":
            return "พฤษภาคม";
            break;
        case "06":
            return "มิถุนายน";
            break;
        case "07":
            return "กรกฎาคม";
            break;
        case "08":
            return "สิงหาคม";
            break;
        case "09":
            return "กันยายน";
            break;
        case "10":
            return "ตุลาคม";
            break;
        case "11":
            return "พฤศจิกายน";
            break;
        case "12":
            return "ธันวาคม";
            break;
    }
}

function month_thai_short($month){
    switch ($month) {
        case "01":
            return "ม.ค.";
            break;
        case "02":
            return "ก.พ.";
            break;
        case "03":
            return "มี.ค.";
            break;
        case "04":
            return "เม.ย.";
            break;
        case "05":
            return "พ.ค.";
            break;
        case "06":
            return "มิ.ย.";
            break;
        case "07":
            return "ก.ค.";
            break;
        case "08":
            return "ส.ค.";
            break;
        case "09":
            return "ก.ย.";
            break;
        case "10":
            return "ต.ค.";
            break;
        case "11":
            return "พ.ย.";
            break;
        case "12":
            return "ธ.ค.";
            break;
    }
}

function newline($word,$digit){
if($word==null){
    return $word;
}
    $line_count = 0;
    $result = array();
    $x = 0;
    $result[0] = "";
    $txt = explode(" ",$word);
    
    foreach($txt as $val){
        if($line_count + strlen($val) > $digit){
            $x++;
            $line_count = 0;
            $result[$x] = "";
        }     
        $result[$x] .= $val;
        $line_count += strlen($val);
    }

    return $result;
}
?>