<!DOCTYPE html>
<html>
<style type="text/css">
  td, th{ padding: 5px; border: 1px solid; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <table width="100%" >
      <tr>
        <th>No</th>
        <th>Bab & Sub Bab</th>
        <th>Waktu Pengerjaan</th>
      </tr>
      <?php $no = 1; $a = 0; $b = 0; foreach ($bab as $key) { ?>
        <tr>
          <td style="text-align: center;"><?= $no++; ?></td>
          <td><b><?= $key->bab; ?></b></td>
          <td>
            <?php 
              $get_waktu_pengerjaan_bab = $this->M_entitas->selectX('waktu_pengerjaan_bab', array('id_kurikulum' => $kurikulum->id_kurikulum, 'id_bab' => $key->id_bab))->row();
              if($get_waktu_pengerjaan_bab){ echo $get_waktu_pengerjaan_bab->waktu_pengerjaan." hari"; $a += $get_waktu_pengerjaan_bab->waktu_pengerjaan; }
            ?>
          </td>
        </tr>
        <?php $get_sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab))->result(); if($get_sub_bab){ $no_sub_bab = "a"; foreach ($get_sub_bab as $sb) { ?>
          <tr>
            <td></td>
            <td><?= $no_sub_bab++.". ".$sb->sub_bab; ?></td>
            <td>
              <?php 
              $get_waktu_pengerjaan_sub_bab = $this->M_entitas->selectX('waktu_pengerjaan_sub_bab', array('id_kurikulum' => $kurikulum->id_kurikulum, 'id_sub_bab' => $sb->id_sub_bab))->row();
              if($get_waktu_pengerjaan_sub_bab){ echo $get_waktu_pengerjaan_sub_bab->waktu_pengerjaan." hari"; $b += $get_waktu_pengerjaan_sub_bab->waktu_pengerjaan; }
            ?>
            </td>
          </tr>
        <?php }} ?>
      <?php } ?>
      <tr>
        <td colspan="2" style="text-align: right;"><b>Total</b></td>
        <td>
          <?php 
            $ab = $a;
            $bc = $b;
            $cd = $ab + $bc;
            echo $cd." hari";
          ?>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>