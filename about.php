<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tentang</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Tentang Kami</h3>
    <p> <a href="home.php">home</a> / Tentang Kami </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>Kenapa Memilih Kami?</h3>
            <p>Toko kami sangat terpercaya, kami memiliki tenaga kerja yang profesional dan bersertifikat. Banyak tokoh terkemuka yang membeli produk kami, tunggu apalagi? mari belanjaaa....</p>
            <a href="shop.php" class="btn">Belanja Sekarang!</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Apa yang kami sediakan?</h3>
            <p>Kami menyediakan berbagai model buket bunga, buket impian anda belum tersedia di katalog? tenangg, anda bisa request konsep loh!! mau tau caranya? hubungi kami sekarang >3</p>
            <a href="contact.php" class="btn">Hubungi Kami</a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>Siapa Kami?</h3>
            <p>Kami merupakan toko bunga profesional yang mampu memanjakan imajinasi dan keinginan anda. Tertarik ingin mencoba produk kami? tapi masih ragu? yuk baca review klien kami dibawah ini, cuss</p>
            <a href="#reviews" class="btn">Ulasan Klien</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Ulasan Klien</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Saya pertama kali membeli buket disini, saya beli untuk istri saya buket pink roses, penjualnya sangat ramah, saya boleh request ditambah duit dan coklat di buketnya!! istri saya senang sekali loh, malah besok minta katanya minta request buketnya yg didalemnya ada kunci mobil mini cooper!! sebaguss itu makanya suka sekali..</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Jong Beo</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Awalnya beli karna coba coba, lucu aja gitu. EH LAMA LAMA AKU KECANDUAN, aku beli buket disini sampai serumah penuh buket, hari hariku bahagia sekali memandang buket bunga yang warna warni ini.. lusyuuu, ayo kawan kawan yang kecanduan narkoba cocok bgt beli bunga ini, kita nyimeng halal..! HIDUP NYIMENG!!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Natasha Perih</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Toko ini boljug!! minta request bunga + dikasih jam tangan bisa dah, mana hasilnya bagus bgt.. laki gua suka bgt dah, langsung makin sayang. FIX LU SEMUA HARUS ORDER DISINI! DISINI TRUSTED BGT, jd pengen nikahin yg bikin buket. marry me mass mbaa :)) sarapan buket tiap pagi gapapa, ngeliatin doang bikin kenyang HEHE</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Alesender Chrisbox</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>saya sangat menyukai pelayanan disini, adminnya ramah dan fast-response ketika kita melakukan konsultasi atau pemesanan custom! harganya juga tidak tidak terlalu mahal, dan kualitas bunga yang diterima sangat baik. saya sangat merekomendasikan membeli dari sini</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Emma Manual</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>saya membeli bucket besar untuk anniversary pernikahan saya, walaupun waktu saya memesanan sudah dekat dengan tanggal anniversary tersebut, bucket yang saya terima sangat bagus dan tidak asal dibuat. bunga masih segar dan juga tidak ada yang busuk, penataannya sangat baik dan sama sekali tidak mengecewakan</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Cean D'Loh</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>tempat langganan saya! pelayanannya sangat baik dan juga selalu menyediakan bunga dengan kualitas terbaik dengan harga yang lebih miring dari pasarannya. cocok untuk memesan bucket pernikahan/wisuda, maupun pembelian bunga hias untuk vas di rumah. dari skala 1 - 10, nilai yang saya berikan adalah 9!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Angelina Sendog</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>