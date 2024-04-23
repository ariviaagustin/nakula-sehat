<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Tambah Master Jadwal</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
                    <span style="font-size: 18px; font-weight: 600; color: #000;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                    <span><b><i class="fa fa-info-circle"></i> Harap teliti terlebih dahulu sebelum melakukan tambah jadwal. Jadwal yang sudah terisi tidak dapat diubah / dihapus.</b></span>
                </div>
            </div>
        </div>
        <?php if($this->session->flashdata("msg")){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                        <span><b><?= $this->session->flashdata("msg"); ?></b></span>
                    </div>
                </div>
            </div>
        <?php } ?>
        <form action="<?= site_url('Kurikulum/aksi_tambah_master_jadwal'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Hari Ke<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="hari_ke" class="form-control select2" required id="pilih_hari" onchange="myFunction_1()">
                                <option value="">-- Pilih Hari --</option>
                                <?php for ($i=1; $i <= $kurikulum->jumlah_hari_pelatihan; $i++) { ?>
                                    <option value="<?= $i; ?>">Hari ke-<?= $i; ?></option>
                                <?php } ?>
                            </select>
                            <!-- <input type="number" class="form-control" name="hari_ke" required=""> -->
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Materi<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="is_materi" value="1" required="" id="ya"> Ya
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_materi" value="2" required="" id="tidak"> Tidak
                        </div>
                    </div>
                    <div style="display: none;" id = "tdk_materi">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Mata Pelatihan<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" class="form-control" name="mata_pelatihan" id="input_mata_pelatihan_kurikulum">
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id = "ya_materi">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Mata Pelatihan<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="id_materi" class="form-control select2" required id="pilih_materi_kurikulum" style="width: 100%;">
                                    <option value="">-- Pilih Materi --</option>
                                    <?php foreach ($materi as $key) { ?>
                                        <option value="<?= $key->id_materi; ?>"><?= $key->materi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Alokasi Waktu<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="radio" name="t_p_pl_materi" value="1" class="alokasi_waktu" onclick="myFunction_2(this.value)"> Teori
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="t_p_pl_materi" value="2" class="alokasi_waktu" onclick="myFunction_2(this.value)"> Penugasan
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="t_p_pl_materi" value="3" class="alokasi_waktu" onclick="myFunction_2(this.value)"> Praktek Lapangan
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">JPL<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="jpl" class="form-control select2" required id="pilih_jpl" style="width: 100%;" onchange="myFunction_3()">
                                    <option value="">-- Pilih JPL --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Waktu Mulai<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="time" class="form-control" name="waktu_awal" required="" id="waktu_awal">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Waktu Selesai<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="time" class="form-control" name="waktu_akhir" required="" id="waktu_akhir">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    $('#ya').change(function(){
        $("#ya_materi").show();
        $("#tdk_materi").hide();
        $("#input_mata_pelatihan_kurikulum").prop('required',false);
        $("#pilih_materi_kurikulum").prop('required',true);
        $("#pilih_jpl").prop('required',true);
        $(".alokasi_waktu").prop('required',true);
    });
    $('#tidak').change(function(){
        $("#ya_materi").hide();
        $("#tdk_materi").show();
        $("#input_mata_pelatihan_kurikulum").prop('required',true);
        $("#pilih_materi_kurikulum").prop('required',false);
        $("#pilih_jpl").prop('required',false);
        $(".alokasi_waktu").prop('required',false);
    });
</script>
<script type="text/javascript">
    function myFunction_1()
    {
        var hari = document.getElementById("pilih_hari").value;
        var id_kurikulum = <?= $kurikulum->id_kurikulum; ?>;
        $.ajax({
          url: '<?= site_url('All/get_master_jadwal');?>/'+hari+'/'+id_kurikulum,
          success: function(data){
            var waktu_awal = data;
            var waktu_awal = waktu_awal.substring(4, 12);
            $("#waktu_awal").val(waktu_awal);
          }
        });
    }
    function myFunction_2(t_p_pl_materi)
    {
        var alokasi_waktu = t_p_pl_materi;
        var id_materi = document.getElementById("pilih_materi_kurikulum").value;
        var id_kurikulum = <?= $kurikulum->id_kurikulum; ?>;
        if(document.getElementById("pilih_materi_kurikulum").value != "")
        {
            var url = "<?= site_url('All/get_jpl_master_jadwal');?>/"+alokasi_waktu+"/"+id_materi+"/"+id_kurikulum;
            $('#pilih_jpl').load(url);
            return false;
        }
        else
        {
            alert("Pilih materi terlebih dahulu");
        }
    }
    function myFunction_3()
    {
        var alokasi_waktu = $("[name='t_p_pl_materi']:checked").val();
        var jpl = document.getElementById("pilih_jpl").value;
        var hari = document.getElementById("pilih_hari").value;
        var id_kurikulum = <?= $kurikulum->id_kurikulum; ?>;
        if(document.getElementById("waktu_awal").value != "")
        {
            $.ajax({
                url: '<?= site_url('All/get_waktu_selesai');?>/'+alokasi_waktu+'/'+jpl+'/'+hari+'/'+id_kurikulum,
                success: function(data){
                    var waktu_akhir = data;
                    var waktu_akhir = waktu_akhir.substring(4, 12);
                    $("#waktu_akhir").val(waktu_akhir);
                }
            });
        }
        else
        {
            alert("Pilih materi / isi waktu awal terlebih dahulu");
        }
    }
</script>