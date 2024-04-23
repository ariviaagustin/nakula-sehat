<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Ubah Master Jadwal</h5>
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
        <form action="<?= site_url('Kurikulum/aksi_ubah_master_jadwal'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Hari Ke<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" class="form-control" name="hari_ke" required="" value="<?= $master_jadwal->hari_ke; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Waktu Mulai<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="time" class="form-control" name="waktu_awal" required="" value="<?= $master_jadwal->waktu_awal; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Waktu Selesai<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="time" class="form-control" name="waktu_akhir" required="" value="<?= $master_jadwal->waktu_akhir; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Materi<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="is_materi" value="1" required="" id="ya" <?php if($master_jadwal->is_materi == 1){ echo "checked"; } ?>> Ya
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_materi" value="2" required="" id="tidak" <?php if($master_jadwal->is_materi == 2){ echo "checked"; } ?>> Tidak
                        </div>
                    </div>
                    <div class="row form-group" style="display: none;" id = "input_mata_pelatihan">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Mata Pelatihan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="mata_pelatihan" id="input_mata_pelatihan_kurikulum" value="<?= $master_jadwal->mata_pelatihan; ?>">
                        </div>
                    </div>
                    <div class="row form-group" style="display: none;" id="pilih_materi">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Mata Pelatihan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="id_materi" class="form-control select2" required id="pilih_materi_kurikulum" style="width: 100%;">
                                <option value="">-- Pilih Materi --</option>
                                <?php foreach ($materi as $key) { ?>
                                    <option value="<?= $key->id_materi; ?>" <?php if($master_jadwal->id_materi == $key->id_materi){ echo "selected"; } ?>><?= $key->materi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group" style="display: none;" id="pilih_alokasi_waktu">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Alokasi Waktu<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="t_p_pl_materi" value="1" class="alokasi_waktu" <?php if($master_jadwal->t_p_pl_materi == 1){ echo "checked"; } ?>> Teori
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="t_p_pl_materi" value="2" class="alokasi_waktu" <?php if($master_jadwal->t_p_pl_materi == 2){ echo "checked"; } ?>> Penugasan
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="t_p_pl_materi" value="3" class="alokasi_waktu" <?php if($master_jadwal->t_p_pl_materi == 3){ echo "checked"; } ?>> Praktek Lapangan
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
                            <input type="hidden" name="id_master_jadwal" value="<?= $master_jadwal->id_master_jadwal; ?>">
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
        $("#pilih_materi").show();
        $("#pilih_alokasi_waktu").show();
        $("#input_mata_pelatihan").hide();
        $("#input_mata_pelatihan_kurikulum").prop('required',false);
        $("#pilih_materi_kurikulum").prop('required',true);
        $(".alokasi_waktu").prop('required',true);
    });
    $('#tidak').change(function(){
        $("#pilih_materi").hide();
        $("#pilih_alokasi_waktu").hide();
        $("#input_mata_pelatihan").show();
        $("#input_mata_pelatihan_kurikulum").prop('required',true);
        $("#pilih_materi_kurikulum").prop('required',false);
        $(".alokasi_waktu").prop('required',false);
    });
</script>
<script type="text/javascript">
    var is_materi = <?= $master_jadwal->is_materi; ?>;
    if(is_materi == 1)
    {
        $("#pilih_materi").show();
        $("#pilih_alokasi_waktu").show();
        $("#input_mata_pelatihan").hide();
        $("#input_mata_pelatihan_kurikulum").prop('required',false);
        $("#pilih_materi_kurikulum").prop('required',true);
        $(".alokasi_waktu").prop('required',true);
    }
    else
    {
        $("#pilih_materi").hide();
        $("#pilih_alokasi_waktu").hide();
        $("#input_mata_pelatihan").show();
        $("#input_mata_pelatihan_kurikulum").prop('required',true);
        $("#pilih_materi_kurikulum").prop('required',false);
        $(".alokasi_waktu").prop('required',false);
    }
</script>