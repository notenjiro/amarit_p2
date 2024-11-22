<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

function genCheckbox($val){
    return '<input style="display:block;" type="checkbox" '.($val==1?'checked':'').'>';
}

function genCheckbox2($type,$id,$col,$val){

    return '<input id="cb-'.$type.'_'.$id.'_'.$col.'" class="cb-custom" style="display:block;" type="checkbox" value="'.($val==1?1:0).'" '.($val==1?'checked':'').'>';
}

if(isset($_GET["type"])){
    $raw = array();

    if($_GET["type"]=="branch"){
        $fQuery = "SELECT code_branch,branch_name FROM FES.dbo.barcode_branch";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [$row["code_branch"],$row["branch_name"]];
        }
    }

    if($_GET["type"]=="group"){
        $type = substr($_GET["type"], -1, 1);
        $fQuery = "SELECT no_group,group_name,WH,UT,RN,CH,TP,TS,LS,PT,BS,IM,SH,AG,PV,SO FROM FES.dbo.barcode_group";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [
                $row["no_group"],
                $row["group_name"],
                genCheckbox2($type,$row["no_group"],"WH",$row["WH"]),
                genCheckbox2($type,$row["no_group"],"UT",$row["UT"]),
                genCheckbox2($type,$row["no_group"],"RN",$row["RN"]),
                genCheckbox2($type,$row["no_group"],"CH",$row["CH"]),
                genCheckbox2($type,$row["no_group"],"TP",$row["TP"]),
                genCheckbox2($type,$row["no_group"],"TS",$row["TS"]),
                genCheckbox2($type,$row["no_group"],"LS",$row["LS"]),
                genCheckbox2($type,$row["no_group"],"PT",$row["PT"]),
                genCheckbox2($type,$row["no_group"],"BS",$row["BS"]),
                genCheckbox2($type,$row["no_group"],"IM",$row["IM"]),
                genCheckbox2($type,$row["no_group"],"SH",$row["SH"]),
                genCheckbox2($type,$row["no_group"],"AG",$row["AG"]),
                genCheckbox2($type,$row["no_group"],"PV",$row["PV"]),
                genCheckbox2($type,$row["no_group"],"SO",$row["SO"])
            ];
        }
    }

    if($_GET["type"]=="location"){
        $fQuery = "SELECT no_location,location_name,WH,UT,RN,CH,TP,TS,LS,PT,BS,IM,SH,AG,PV,SO FROM FES.dbo.barcode_location";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [
                $row["no_location"],
                $row["location_name"],
                genCheckbox($row["WH"]),
                genCheckbox($row["UT"]),
                genCheckbox($row["RN"]),
                genCheckbox($row["CH"]),
                genCheckbox($row["TP"]),
                genCheckbox($row["TS"]),
                genCheckbox($row["LS"]),
                genCheckbox($row["PT"]),
                genCheckbox($row["BS"]),
                genCheckbox($row["IM"]),
                genCheckbox($row["SH"]),
                genCheckbox($row["AG"]),
                genCheckbox($row["PV"]),
                genCheckbox($row["SO"])
            ];
        }
    }

    if($_GET["type"]=="product_type"){
        $fQuery = "SELECT no_product_type, product_type_name, WH, UT, RN, CH, TP, TS, LS, PT, BS, IM, SH, AG, PV, SO FROM FES.dbo.barcode_product_type;";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [
                $row["no_product_type"],
                $row["product_type_name"],
                genCheckbox($row["WH"]),
                genCheckbox($row["UT"]),
                genCheckbox($row["RN"]),
                genCheckbox($row["CH"]),
                genCheckbox($row["TP"]),
                genCheckbox($row["TS"]),
                genCheckbox($row["LS"]),
                genCheckbox($row["PT"]),
                genCheckbox($row["BS"]),
                genCheckbox($row["IM"]),
                genCheckbox($row["SH"]),
                genCheckbox($row["AG"]),
                genCheckbox($row["PV"]),
                genCheckbox($row["SO"])
            ];
        }
    }

    if($_GET["type"]=="service"){
        $fQuery = "SELECT no_service, type_service_name, [group] FROM FES.dbo.barcode_service;";
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [
                "<input type='checkbox' class='d-block'>",
                $row["no_service"],
                $row["type_service_name"],
                $row["group"],
            ];
        }
    }

    
    if(
           $_GET["type"]=="sub_type1"
        || $_GET["type"]=="sub_type2"
        || $_GET["type"]=="sub_type3"
        || $_GET["type"]=="sub_type4"
        || $_GET["type"]=="sub_type5"
        || $_GET["type"]=="sub_type6"
    ){
$type = substr($_GET["type"], -1, 1);
        $fQuery = "SELECT no_sub_type".$type.", sub_type".$type.", WH, UT, RN, CH, TP, TS, LS, PT, BS, IM, SH, AG, PV, SO FROM FES.dbo.barcode_sub_type".$type.";";
        
        $result = sqlsrv_query($conn, $fQuery);
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            $raw[] = [
                $row["no_sub_type".$type],
                $row["sub_type".$type],
                genCheckbox2($type,$row["no_sub_type".$type],"WH",$row["WH"]),
                genCheckbox2($type,$row["no_sub_type".$type],"UT",$row["UT"]),
                genCheckbox2($type,$row["no_sub_type".$type],"RN",$row["RN"]),
                genCheckbox2($type,$row["no_sub_type".$type],"CH",$row["CH"]),
                genCheckbox2($type,$row["no_sub_type".$type],"TP",$row["TP"]),
                genCheckbox2($type,$row["no_sub_type".$type],"TS",$row["TS"]),
                genCheckbox2($type,$row["no_sub_type".$type],"LS",$row["LS"]),
                genCheckbox2($type,$row["no_sub_type".$type],"PT",$row["PT"]),
                genCheckbox2($type,$row["no_sub_type".$type],"BS",$row["BS"]),
                genCheckbox2($type,$row["no_sub_type".$type],"IM",$row["IM"]),
                genCheckbox2($type,$row["no_sub_type".$type],"SH",$row["SH"]),
                genCheckbox2($type,$row["no_sub_type".$type],"AG",$row["AG"]),
                genCheckbox2($type,$row["no_sub_type".$type],"PV",$row["PV"]),
                genCheckbox2($type,$row["no_sub_type".$type],"SO",$row["SO"])
            ];
        }
    }


 header('Content-Type: application/json');
echo json_encode(array("data"=>$raw));
sqlsrv_close($conn);
    
}

?>