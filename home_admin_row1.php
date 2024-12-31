            <a style='color:#000' href='index.php?view=siswa'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                <?php $siswa = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM petugas")); ?>
                  <span class="info-box-text">Operator</span>
                  <span class="info-box-number"><?php echo $siswa[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=guru'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                <?php $guru = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM amil")); ?>
                  <span class="info-box-text">Amil</span>
                  <span class="info-box-number"><?php echo $guru[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=bahantugas'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                <?php $upload = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM kategori")); ?>
                  <span class="info-box-text">Kategori</span>
                  <span class="info-box-number"><?php echo $upload[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=forum'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                <?php $forum = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM barang")); ?>
                  <span class="info-box-text">Barang</span>
                  <span class="info-box-number"><?php echo $forum[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>