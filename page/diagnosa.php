

<div class="pagetitle">
      <h1>Diagnosa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=home">Home</a></li>
          <li class="breadcrumb-item active">Diagnosa</li>
        </ol>
      </nav>
    </div>


<section class="containter">
      <div class="row">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Diagnosa</button>
             <?php 
              $sql = mysqli_query($conn,"SELECT *FROM diagnosa");
              while ($data = mysqli_fetch_array($sql)){
              ?>
            <div class="card-body">
            <div class="card text-center" style="width: 20rem; font-size:1.5rem">
            <h5 class="card-title ">Diagnosa Nomor (<?php echo $data['id'] ?>)</h5>
            <img class="card-img-top" src="assets/img/people.jpg" alt="Card image cap">
            <div class="card-body">
              
              <p class="card-text text-left">Nama : <?php echo $data['nama'] ?> </p>
              <p class="card-text text-left">Umur    : <?php echo $data['umur'] ?> </p>
              <p class="card-text text-left">HP    : <?php echo $data['hp'] ?> </p>
              <hr>
              <hr>
              <p class="card-text text-left">Jantung : <?php echo $data['jantung'] ?> </p>
              <p class="card-text text-left">Suhu    : <?php echo $data['suhu'] ?> </p>
              <p class="card-text text-left">Gula    : <?php echo $data['gula'] ?> </p>
            </div>
            </div>
            </div>
            <?php } ?>
      </div>
    </section>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Diagnosa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data" class="text-center">
      
      <div class="mb-3 text-left">
      <label for="id" class="form-label ">ID Pasien</label>
      <input type="number" class="form-control" id="id" name="id" placeholder="Masukkan ID Pasien">
      </div>
      
      <div class="mb-3 text-left">
      <label for="nama" class="form-label">Nama Pasien</label>
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Pasien">
      </div>
      
      <div class="mb-3 text-left">
      <label for="id" class="form-label">Umur Pasien</label>
      <input type="number" class="form-control" id="umur" name="umur" placeholder="Masukkan Umur Pasien">
      </div>

      <div class="mb-3 text-left">
      <label for="hp" class="form-label">No HP Pasien</label>
      <input type="text" class="form-control" id="hp" name="hp" placeholder="+62 Masukkan No HP">
      </div>
      <button type="submit" name="tambah_diagnosa" value="tambah_diagnosa" class="btn centeralign-content-center btn-primary" >Tambah</button>
      </form>
      
      </div>
      </div>
    </div>
  </div>
</div>