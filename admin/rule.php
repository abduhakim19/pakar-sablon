<?php 
  require('../database/koneksi.php');
  require('../helpers/util.php');

  require('./components/header.php');
  require('./components/navbar.php');

  $querySablon = "SELECT * FROM tb_sablon";
  $resultSablon = mysqli_query($conn, $querySablon);

  $queryCiri = "SELECT * FROM tb_ciri";
  $resultCiri = mysqli_query($conn, $queryCiri);
  ?>
    <div id="layoutSidenav">
      <?php require('./components/menu.php'); ?>
      <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-3">Rule</h3>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Rule</li>
                </ol>
                <div class="card mb-3 col-6">
                  <div class="card-header bg-primary text-white">Cari Jenis Sablon</div>
                  <div class="card-body">
                    <div class="row">                    
                      <div class="col-8">
                        <select class="form-control select2" id="selectsablon" style="width: 100%;">
                            <option value="" selected="selected" disabled>Pilih Jenis Sablon</option>
                            <?php while($r = mysqli_fetch_array($resultSablon)) { ?>  
                                <option value="<?=$r['kd_sablon']?>"><?=$r['nama_sablon']?> - <?=$r['kd_sablon']?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="col-4">
                          <button type="submit" class="btn btn-primary" id="btnsablon">Cari</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card  col-12">
                  <div class="card-header">Daftar Ciri-Ciri Sablon</div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#ciriModal">Tambah</button>
                      <table class="table table-striped table-hover table-bordered" id="table-ciri">
                        <thead>
                            <tr data-widget="expandable-table" aria-expanded="false">
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Ciri</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </main>
        <?php require('./components/footer.php'); ?>
      </div>
    </div>

    <div class="modal fade" id="ciriModal" tabindex="-1" aria-labelledby="ciriModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ciri-ciri</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="form-ciri" >
            <div class="modal-body">
              <div class="mb-2">
                <label for="inputNamaSablon" class="col-form-label">Jenis Sablon</label>
                <input type="text" class="form-control" id="inputNamaSablon" disabled>
                <input type="hidden" id="inputKodeSablon" name="inputKodeSablon">
              </div>
              <div class="mb-2">
                <label for="inputCiri" class="col-form-label">Ciri-ciri</label>
                <select class="form-control" id="selectciri" style="width: 100%;">
                    <option value="atas" selected="selected" disabled>Pilih Ciri-Ciri Sablon</option>
                    <?php while($r = mysqli_fetch_array($resultCiri)) { ?>  
                        <option value="<?=$r['kd_ciri']?>"><?=$r['ciri']?> - <?=$r['kd_ciri']?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanCiri" name="simpan" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#selectsablon').select2();
        $('#selectciri').select2({
          dropdownParent: $('#ciriModal')
        });


        $('#btnsablon').click(function() {
            $('#inputNamaSablon').val($( "#selectsablon option:selected" ).text());
            const kd_sablon = $( "#selectsablon" ).val();
            $('#inputKodeSablon').val(kd_sablon);
            cariSablon(kd_sablon);
        })

        $('#btnSimpanCiri').click(function() {
            tambahCiri();
        })        

        function cariSablon(kd_sablon) {
            
            $.post('proses-rule.php',
            {
                name: 'cari-sablon',
                data:kd_sablon
            },
            function(data){
                console.log(data);
                const dataJSON = JSON.parse(data);
                tableCiri(dataJSON);
                if (dataJSON.length > 0) {
                  btnHapusCiri();
                }
            });
        }

        function tableCiri(res) {
            let htmlView = '';
            if(res.length <= 0){
                htmlView+= `
                <tr>
                    <td colspan="4">No data.</td>
                </tr>`;
            } else {
                for(let i = 0; i < res.length; i++){
                  htmlView += `
                      <tr id="index_`+res[i].id+`">
                      <td>`+ (i+1) +`</td>
                          <td>`+res[i].kd_ciri+`</td>
                          <td>`+res[i].ciri+`</td>
                          <td class="aksi">
                            <a href="javascript:void(0)" class="btn btn-danger btnHapusCiri" data-id="`+res[i].id+`">
                              <i class="fas fa-trash"></i>
                            </a>
                          </td>
                      </tr>`;
                }
            }
            $('tbody').html(htmlView);
        }

        function btnHapusCiri() {
          $('.btnHapusCiri').click(function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            hapusCiri(id);
          });
        }
        function hapusCiri(id) {
          $.post('proses-rule.php',
            {
                name: 'hapus',
                id: id
            },
            function(data){
              console.log(data, 'hapus');
              dataJSON = JSON.parse(data);
              Swal.fire({
                  position: 'top-end',
                  icon: `${dataJSON.status}`,
                  title: `${dataJSON.content}`,
                  showConfirmButton: false,
                  timer: 1500
              });
              $(`#index_${id}`).remove();
              const getNumber = parseInt($('table tr:last-child td:first-child').html());
              if (isNaN(getNumber)) {
                console.log('hello');
                const htmlView = `
                  <tr>
                      <td colspan="4">No data.</td>
                  </tr>`;
                $('tbody').html(htmlView);
              }
            });
        }


        function tambahCiri() {
          const kodeSablon= $('#inputKodeSablon').val();
          const kodeCiri= $('#selectciri').val();
          $.post('proses-rule.php',
            {
                name: 'simpan',
                kodeSablon: kodeSablon,
                kodeCiri: kodeCiri
            },
            function(data){
              const dataJSON = JSON.parse(data);
              let getNumber = parseInt($('table tr:last-child td:first-child').html());
              if (isNaN(getNumber)) {
                $('tbody tr').remove();
                getNumber = 0
              }
              let ciri = `
                  <tr id="index_`+dataJSON.data.id+`">
                    <td>${getNumber+1}</td>
                        <td>`+dataJSON.data.kd_ciri+`</td>
                        <td>`+dataJSON.data.ciri+`</td>
                        <td class="aksi">
                          <a href="javascript:void(0)" class="btn btn-danger btnHapusCiri" data-id="`+dataJSON.data.id+`">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                    </tr>`;
              
              $('tbody').append(ciri);
              Swal.fire({
                  position: 'top-end',
                  icon: `${dataJSON.status}`,
                  title: `${dataJSON.content}`,
                  showConfirmButton: false,
                  timer: 1500
              });
              $("#selectciri").val(['atas']).trigger('change');
              btnHapusCiri();
            });
        }
      });
    </script>
  </body>
</html>