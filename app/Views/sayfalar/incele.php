<div class="container" style="margin-top: 250px; margin-bottom: 290px;">

    <div class="row">

        <div class="col-lg-12">


            <!-- Title -->
            <h1 class="mt-4 text-primary"><i><?= esc($veri['baslik']) ?></i></h1>

            <p style="font-size: x-large;">
                <img src="<?= base_url('uploads/' . esc($veri['resim'])) ?>" style="height:100px float: left; margin: 10px;height: 200px;">
                <?= esc($veri['icerik']) ?>
            </p>
            <hr>


        </div>


    </div>
    <!-- /.row -->

</div>