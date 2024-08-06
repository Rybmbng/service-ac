<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=home">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
<?php
$hariini=date("Y-m-d");
?>
    <section class="section dashboard">
      <div class="row">
            <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                    <th scope="col">ID Telegram</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Status</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Update</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sql = mysqli_query($conn,"SELECT *FROM dataService WHERE idTelegram !=''");
                    while ($data = mysqli_fetch_array($sql)){
                    ?>
                      <tr>
                        <th scope="row"><?php echo $data['idTelegram'] ?></th>
                        <th scope="row"><?php echo $data['nama'] ?></th>
                        <th scope="row"><?php echo $data['tanggal'] ?></th>
                        <th scope="row"><?php echo $data['status'] ?></th>
                        <th scope="row"><a href="https://www.google.com/maps/place/0%C2%B057'20.8%22S+100%C2%B023'48.8%22E/@<?php echo $data['latitude']?>,<?php echo $data['longitude']?>,17z/data=!3m1!4b1!4m4!3m3!8m2!3d-0.9557778!4d100.3968889?entry=ttu">Maps</a></th>
                        <?php
                        if($data['jenis'] == '1'){
                          echo("<th scope='row'>Cuci AC</th>");
                        }else  if($data['jenis'] == '2'){
                          echo("<th scope='row'>Bongkar Pasang AC</th>");
                        }else  if($data['jenis'] == '3'){
                          echo("<th scope='row'>Perbaikan AC</th>");
                        }else
                        ?>   
                        <div>
                        </th>
                        </div> 
                        <?php
                       if($data['status'] == 'Menunggu'){                       
                        echo "<th scope='row'>Rp.$data[biaya]</th>";
                        echo("<th scope='row'><a href='?page=proses&id=$data[idTelegram]' class='btn btn-primary'> Proses </a></th>");
                      }
                      if($data['status'] == 'Proses'){
                        echo "<th scope='row'>Rp.$data[biaya]</th>";
                        echo "<th scope='row'>";
                        echo "<form method='POST' action='updateBiaya.php'>
                                <input type='hidden' name='harga' value='".$data['biaya']."'>
                                <input type='hidden' name='id' value='".$data['idTelegram']."'>
                                <input type='text' name='biaya' value=''>
                                <input type='submit' class='btn btn-primary' value='Tambah Biaya Service '>
                              </form>";
                              echo("<th scope='row'><a href='?page=selesai&id=$data[idTelegram]' class='btn btn-primary'> Selesai </a></th>");

                      }                      
                        ?>
                      </tr>
                      <?php }?>
                      
                      </tbody>
                  </table>
                </div>
      </div>
    </section>
