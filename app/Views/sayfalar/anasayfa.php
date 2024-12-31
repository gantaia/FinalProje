<!-- Services-->
<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">İşte Yıldız Sistemi</h2>
        <hr class="divider" />
        <div class="row gx-4 gx-lg-5">
        </div>
    </div>
</section>
<!-- Portfolio-->
<div id="portfolio">
    <div style="margin-bottom: 50px;" class="container m-6">
        <div class="row">
            <?php
            if (isset($kayitlar) && count($kayitlar) > 0) {

                foreach ($kayitlar as $item) {
                    echo '<div style="margin-bottom: 50px" class="col-lg-4 col-sm-6">';
                    echo '<img class="menu-img img-fluid" src="' . base_url("uploads/") . $item['resim'] . '"/>';
                    echo '<h4 class="mt-4">' . $item['baslik'] . '</h4>';
                    echo '<p>' . word_limiter($item['icerik'], 10) . '</p>';
                    echo '<a href ="' . base_url('incele/' . $item['url']) . '" class ="btn btn-secondary">incele</a>';
                    echo '</div>';
                }
            ?>
            <?php
            } else {
            ?>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<!-- Call to action-->
<section id="yorumlar" class="page-section bg-dark text-white">
    <div class="container px-4 px-lg-5 text-center">
        <h2 class="mb-4">ISTEKLERİNE GÖRE ŞEKİLLENELİM!</h2>

        <?php if (!empty($yorumlar)): ?>
            <?php foreach ($yorumlar as $yorum): ?>
                <div class="lead card text-black h-20 mb-3 p-3">
                    <h5><?= esc($yorum['baslik']) ?></h5> <!-- Başlık -->
                    <p><?= esc($yorum['icerik']) ?></p> <!-- İçerik -->
                    <small><?= esc($yorum['yazar']) ?> - <?= esc($yorum['tarih']) ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="lead card text-black h-20">Henüz yorum bulunmamaktadır.</p>
        <?php endif; ?>
    </div>
</section>