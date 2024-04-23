<style type="text/css">
    th
    {
        text-align: center;
        vertical-align: top;
    }
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="font-size: 17px">Logo</h5>
                </div>
            </div>
        </div>
        <div class="card-body" style="padding: 10px">
            <table width="100%">
                <tr>
                    <td colspan="2"><h6>Logo Saat Ini</h6></td>
                </tr>
                <tr>
                    <td style="width: 85%;"><br><img src="<?= base_url('agenda/perdata/bg/'.$datalogo->logo); ?>" style = "width: 100%;"></td>
                    <td style="vertical-align: top; "><a href="<?= site_url('ubah-logo/'.bin2hex(base64_encode($datalogo->id_logo))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a></td>
                </tr>
            </table>
        </div>
    </div>
</div></div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>