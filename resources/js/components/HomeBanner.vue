<template>
    <section class="slider-area position-relative">
        <div class="third-slider-active">
            <div v-for="item in homeBanners" :key="item.id" class="third-slider-item third-slider-bg"
                style="background-image: url('/front_assets/img/slider/third_slider_bg.jpg')">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">

                                    <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4"
                                        data-duration-in="1.5">{{ item.text }}</h2>

                                    <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp"
                                        data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape"
                                        data-background="/front_assets/img/slider/third_slide_shape.png"
                                        data-animation-in="zoomIn" data-delay-in="1" data-duration-in="1.5">
                                    </div>
                                    <img style="max-width: 400px;" :src="item.image" alt="" class="main-img"
                                        data-animation-in="slideInRight2" data-delay-in="1" data-duration-in="1.5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
<script>
export default {
    name: 'HomeBanner',
    props: {
        homeBanners: {
            type: Array,
            default: () => [],
        },
    }
}
</script>
