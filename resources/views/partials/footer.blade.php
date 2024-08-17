<div class="container mb-2 mt-5 bg-body-tertiary bg-dark border-bottom border-body py-3 rounded">
    <footer class="text-center text-lg-start text-white">
        <div class="container p-4 pb-0">
            <section class="">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h5 class="text-uppercase mb-4 fw-bold color-font-primary">
                            Sistem Informasi Geografis <br> Sebaran Kesehatan
                        </h5>
                        <p>
                            Platform digital berbasis web yang memetakan dan menganalisis sebaran kesehatan suatu
                            wilayah secara online melalui visualisasi yang interaktif.

                        </p>
                    </div>

                    <hr class="w-100 clearfix d-md-none" />
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 fw-bold text-white">Sebaran Kesehatan</h6>
                        <p>
                            <a class="text-white" href="/sebaran/pusat-kesehatan" style="">Pusat Kesehatan</a>
                        </p>
                        <p>
                            <a class="text-white" href="/sebaran/fasilitas-kesehatan">Fasilitas Kesehatan</a>
                        </p>
                        <p>
                            <a class="text-white" href="/sebaran/layanan-kesehatan">Layanan Kesehatan</a>
                        </p>
                        <p>
                            <a class="text-white" href="/sebaran/kondisi-kesehatan">Kondisi Kesehatan</a>
                        </p>
                        <p>
                            <a class="text-white" href="/pemantauan-penyakit">Pemantauan Penyakit</a>
                        </p>
                    </div>
                    <hr class="w-100 clearfix d-md-none" />
                    <hr class="w-100 clearfix d-md-none" />
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 fw-bold text-white">Kontak</h6>
                        <p><i class="bi bi-house-door-fill mr-3"></i> {{ $profil_kecamatan->alamat }}</p>
                        <p><i class="bi bi-envelope-fill mr-3"></i> {{ $profil_kecamatan->email }}</p>
                        <p><i class="bi bi-telephone-plus-fill mr-3"></i> {{ $profil_kecamatan->no_tlpn }}</p>
                        <p> Latitude : <span> {{ $profil_kecamatan->latitude }}</span></p>
                        <p> Longitude : <span> {{ $profil_kecamatan->longitude }}</span></p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold text-white">Kecamatan {{
                            $profil_kecamatan->nama }}
                        </h6>
                        <a class="text-white" href="https://kec-ngombol.purworejokab.go.id/" target="_blank">Website <i
                                class="bi bi-arrow-right-square-fill"></i></a>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1175.1359023344144!2d109.96343064362523!3d-7.8246806303563625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7ae7e594c53a93%3A0x4eedeabc1f7f0457!2sKantor%20Kecamatan%20Ngombol!5e0!3m2!1sid!2sid!4v1723828780559!5m2!1sid!2sid"
                            width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Fajrunss7@gmail.com</a>
        </div>
    </footer>
</div>