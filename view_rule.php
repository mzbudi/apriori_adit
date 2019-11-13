<?php
//session_start();
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
include_once "display_mining.php";
?>
<section class="page_head">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="page_title">
                    <h2 align="center">Hasil Analisa</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

if (isset($_POST['submit'])) {
?>
    <div class="super_sub_content">
        <div class="container">
            <div class="row">
                <?php
                $can_process = true;
                if (empty($_POST['min_support']) || empty($_POST['min_confidence'])) {
                    $can_process = false;
                    ?>
                    <script> location.replace("?menu=view_rule&pesan_error=Min Support dan Min Confidence harus diisi");</script>
                    <?php
                }
                if(!is_numeric($_POST['min_support']) || !is_numeric($_POST['min_confidence'])){
                    $can_process = false;
                    ?>
                    <script> location.replace("?menu=view_rule&pesan_error=Min Support dan Min Confidence harus diisi angka");</script>
                    <?php
                }
                
                if($can_process){
                    $id_process = $_POST['id_process'];
                    
                    $tgl = explode(" - ", $_POST['range_tanggal']);
                    $start = format_date($tgl[0]);
                    $end = format_date($tgl[1]);
                    
                    echo "Min Support Absolut: " . $_POST['min_support'];
                    echo "<br>";
                    $sql = "SELECT COUNT(*) FROM transaksi 
                    WHERE transaction_date BETWEEN '$start' AND '$end' ";
                    $res = $db_object->db_query($sql);
                    $num = $db_object->db_fetch_array($res);
                    $minSupportRelatif = ($_POST['min_support']/$num[0]) * 100;
                    echo "Min Support Relatif: " . $minSupportRelatif;
                    echo "<br>";
                    echo "Min Confidence: " . $_POST['min_confidence'];
                    echo "<br>";
                    echo "Start Date: " . $_POST['range_tanggal'];
                    echo "<br>";
                    
                    //delete hitungan untuk id_process
                    reset_hitungan($db_object, $id_process);
                    
                    //update log process
                    $field = array(
                                    "start_date"=>$start,
                                    "end_date"=>$end,
                                    "min_support"=>$_POST['min_support'],
                                    "min_confidence"=>$_POST['min_confidence']
                                );
                    $where = array(
                                    "id"=>$id_process
                                );
                    $query = $db_object->update_record("process_log", $field, $where);

                    $result = mining_process($db_object, $_POST['min_support'], $_POST['min_confidence'],
                            $start, $end, $id_process);
                    if ($result) {
                        display_success("Proses mining selesai");
                    } else {
                        display_error("Gagal mendapatkan aturan asosiasi");
                    }
                    
                    display_process_hasil_mining($db_object, $id_process);
                }
                ?>
                
            </div>
        </div>
    </div>
    <?php
} 

else{
$id_process = 0;
if(isset($_GET['id_process'])){
    $id_process = $_GET['id_process'];
}
$sql = "SELECT
        conf.*, log.start_date, log.end_date
        FROM
         confidence conf, process_log log
        WHERE conf.id_process = '$id_process' "
        . " AND conf.id_process = log.id "
        . " AND conf.from_itemset=3 "
        ;//. " ORDER BY conf.lolos DESC";
//        echo $sql;
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);


$sql1 = "SELECT
        conf.*, log.start_date, log.end_date
        FROM
         confidence conf, process_log log
        WHERE conf.id_process = '$id_process' "
        . " AND conf.id_process = log.id "
        . " AND conf.from_itemset=2 "
        ;//. " ORDER BY conf.lolos DESC";
//        echo $sql;
$query1=$db_object->db_query($sql1);
$jumlah1=$db_object->db_num_rows($query1);

$sql_log = "SELECT * FROM process_log
WHERE id = ".$id_process;
$res_log = $db_object->db_query($sql_log);
$row_log = $db_object->db_fetch_array($res_log);
?>

<div class="super_sub_content">
    <div class="container">
        <div class="row">
            <?php
//            if($jumlah==0){
//                    echo "Data kosong...";
//            }
//            else{
            ?>
            
       
                <?php

                // CONFIDENCE 3
                    $no=1;
                    $data_confidence = array();
                    while($row=$db_object->db_fetch_array($query)){
                        
                        $no++;
                        //if($row['confidence']>=$row['min_cofidence']){
                        if($row['lolos']==1){
                        $data_confidence[] = $row;
                        }
                    }
                    ?>
            
         
        
                <?php
                //CONFIDENCE 2

                    $no=1;
                    while($row=$db_object->db_fetch_array($query1)){
                        $no++;
                        //if($row['confidence']>=$row['min_cofidence']){
                        if($row['lolos']==1){
                        $data_confidence[] = $row;
                        }
                    }
                    ?>
            
            
            <strong>Rule Asosiasi:</strong>
            <table class='table table-bordered table-striped  table-hover'>
       
                <?php
                    $no=1;
                    //while($row=$db_object->db_fetch_array($query)){
                    foreach($data_confidence as $key => $val){
                        if($no==1){
                            echo "<br>";
                            echo "Min support: ".$val['min_support'];
                            echo "<br>";
                            echo "Min confidence: ".$val['min_confidence'];
                            echo "<br>";
                            echo "Start Date: ".format_date_db($val['start_date']);
                            echo "<br>";
                            echo "End Date: ".format_date_db($val['end_date']);
                        }
                     
                        $no++;
                    }
                    ?>
            </table>
            <h2>Hasil Analisa</h2>
            <a href="export/CLP.php?id_process=<?php echo $id_process; ?>" class="btn btn-primary" target="blank">
                Export Excel
            </a>
            <br>
            <table class='table table-bordered table-striped  table-hover'>
                <?php
                $no=1;
                //while($row=$db_object->db_fetch_array($query)){
                foreach($data_confidence as $key => $val){
                    if($val['lolos']==1){
                        echo "<tr>";
                        echo "<td>".$no.". Jika konsumen membeli ".$val['kombinasi1']
                                .", maka konsumen juga akan membeli ".$val['kombinasi2']."</td>";
                        echo "</tr>";
                    }
                    $no++;
                }
                ?>
            </table>
            
        </div>
    </div>
</div>
<?php
}
?>