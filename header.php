<?php 
$menu = '';
if(isset($_GET['menu'])){
    $menu = $_GET['menu'];
}

?>

<header class="site-header container-fluid" >
            <div class="top-header" align="center" style="background-color: #efefef">
                <div class="logo col-md-12 col-sm-12">
                    <h1><a href="index.php"><em>PRI</em>MART</a></h1><br/>
                    <span>Implementasi Data Mining Pada Data Pembelanjaan Pembeli Pada Minimarket Primart</span>
                </div> <!-- /.logo -->
                
            </div> <!-- /.top-header -->
            <div class="main-header" style="background-color: #efefef">
                <div class="row">
                    <div class="main-header-left col-md-3 col-sm-6 col-xs-8">
                        <?php 
                        if (!isset($_GET['menu']) || $_GET['menu']=='home' ) {
                            //'', home
                        ?>
                        <?php 
                        }
                        ?>
                    </div> <!-- /.main-header-left -->
                    <div class="menu-wrapper col-md-9 col-sm-6 col-xs-4">
                        <a href="#" class="toggle-menu visible-sm visible-xs"><i class="fa fa-bars"></i></a>
                        <ul class="sf-menu hidden-xs hidden-sm">
                            <li ><a href="index.php">beranda</a></li>
                        <?php
                        if (empty($_SESSION['apriori_toko_id'])) {
                        ?>
                            <li><a href="location.php">Lokasi</a></li>
                            <li><a href="login.php">Login</a></li>
                        <?php 
                        }
                        else{
                            if($_SESSION['apriori_toko_level']==1){
                        ?>
                            <li <?php echo ($menu=='data_transaksi')?"class='active'":""; ?> ><a href="index.php?menu=data_transaksi">Data Transaksi</a></li>
                            <li <?php echo ($menu=='proses_apriori')?"class='active'":""; ?>><a href="index.php?menu=proses_apriori">Proses Apriori</a></li>
                            <?php
                            }
                            ?>
                            <li <?php echo ($menu=='hasil_rule')?"class='active'":""; ?>><a href="index.php?menu=hasil_rule">Hasil Rule</a></li>
                            <li ><a href="logout.php">Logout</a></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </div> <!-- /.menu-wrapper -->
                </div> <!-- /.row -->
            </div> <!-- /.main-header -->
            <div id="responsive-menu" style="background-color: #efefef">
                <ul>
                    <li class="active"><a href="index.php">Beranda</a></li>
                    <?php
                    if (empty($_SESSION['apriori_toko_id'])) {
                    ?>
                        <li><a href="login.php">Login</a></li>
                    <?php 
                    }
                    else{
                    ?>
                        <li <?php echo ($menu=='data_transaksi')?"class='active'":""; ?>><a href="index.php?menu=data_transaksi">Data Transaksi</a></li>
                        <li <?php echo ($menu=='proses_apriori')?"class='active'":""; ?>><a href="index.php?menu=proses_apriori">Proses Apriori</a></li>
                        <li <?php echo ($menu=='hasil_rule')?"class='active'":""; ?>><a href="index.php?menu=hasil_rule">Hasil Rule</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </header> <!-- /.site-header -->