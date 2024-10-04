<?php
require_once "Models/Banner.php";
$banner = new Banner();
$list_slider = $banner->get_list_slide();
?>
<div class="banner">
    <div class="banner">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
           
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">         
            <div class="col-7 bg-white" style="height:400px;">
                <!-- // -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  </div>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php $index = 0; ?>
                        <?php foreach($list_slider as $slider):?>
                            <?php if($index == 0): ?>
                            <img src="public/images/banner/<?= $slider['image']; ?>" class="d-block w-100" alt="<?= $slider['image']; ?>" style="width: 732px; height: 370px;">
                        </div>
                        <?php else:?>
                        <div class="carousel-item">
                        <img src="public/images/banner/<?= $slider['image']; ?>" class="d-block w-100" alt="<?= $slider['image']; ?>" style="width: 732px; height: 370px;">
                    </div>
                    <?php endif;?>
                    <?php $index ++; ?>
                    <?php endforeach;?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
              </button>
 
                </div>
            </div>
            <div class="col-3 bg-white">
                <!-- 530 -->
                <img src="public\image\qc2.png" style="height:180px; width:600px;">
                <img src="public\image\h2.webp" style="height:185px; width:600px; margin-top:5px;">
            </div>
        </div>
    </div>