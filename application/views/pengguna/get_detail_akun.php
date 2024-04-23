<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <table width="100%" border="0">
      <tr>
        <td style="width:15%;">Nama</td>
        <td style="width: 1%;">:</td>
        <td><?= $user->nama_lengkap; ?></td>
      </tr>
      <tr>
        <td>Username</td>
        <td>:</td>
        <td><?= $akun->username; ?></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td><?= $akun->password; ?></td>
      </tr>
    </table>
  </div>
</body>
</html>