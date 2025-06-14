<template>
    <!-- slider-area -->
    <HomeBanner :homeBanners="homeBanners" />
    <!-- slider-area-end -->

    <!-- shoes-category-area -->
    <HomeCategory :homeCategories="homeCategories" />
    <!-- shoes-category-area-end -->

    <!-- trending-product-area -->
    <TrendingProducts :homeCategories="homeCategories" />
    <!-- trending-product-area-end -->

    <!-- new-arrival-area -->
    <HomeProducts :homeProducts="homeProducts" />
    <!-- new-arrival-area-end -->

    <!-- shoes-banner-area -->
    <section class="shoes-banner-area">
        <div class="container">
            <div class="shoes-banner-active">
                <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                    <div class="row">
                        <div class="col-12">
                            <div class="shoes-banner-content">
                                <h6>Athletes Shoes</h6>
                                <h2>9 Best <span>Shoes for</span> Standing All Day Review 2020</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                    <div class="row">
                        <div class="col-12">
                            <div class="shoes-banner-content">
                                <h6>Athletes Shoes</h6>
                                <h2>3 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shoes-banner-bg" data-background="/front_assets/img/bg/shoes-banner_bg.jpg">
                    <div class="row">
                        <div class="col-12">
                            <div class="shoes-banner-content">
                                <h6>Athletes Shoes</h6>
                                <h2>8 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shoes-banner-area-end -->

    <!-- promo-services -->
    <section class="promo-services pt-70 pb-25">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="promo-services-item mb-40">
                        <div class="icon"><img src="/front_assets/img/icon/promo_icon01.png" alt=""></div>
                        <div class="content">
                            <h6>payment & delivery</h6>
                            <p>Delivered, when you receive arrives</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="promo-services-item mb-40">
                        <div class="icon"><img src="/front_assets/img/icon/promo_icon02.png" alt=""></div>
                        <div class="content">
                            <h6>Return Product</h6>
                            <p>Retail, a Product Return Process</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="promo-services-item mb-40">
                        <div class="icon"><img src="/front_assets/img/icon/promo_icon03.png" alt=""></div>
                        <div class="content">
                            <h6>money back guarantee</h6>
                            <p>Options Including 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="promo-services-item mb-40">
                        <div class="icon"><img src="/front_assets/img/icon/promo_icon04.png" alt=""></div>
                        <div class="content">
                            <h6>Quality support</h6>
                            <p>Support Options Including 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- promo-services-end -->

    <!-- instagram-post-area -->
    <div class="instagram-post-area">
        <div class="container-fluid p-0 fix">
            <div class="row no-gutters insta-active">
                <div v-for="item in homeBrands" :key="item.id" class="col">
                    <div class="insta-post-item">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                            <img :src="item.image" alt="">
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- instagram-post-area-end -->



</template>
<script>
import axios from 'axios';
import getUrlList from '../provider';
import Layout from './Layout.vue';
import HomeBanner from '../components/HomeBanner.vue';
import HomeCategory from '../components/HomeCategory.vue';
import TrendingProducts from '../components/TrendingProducts.vue';
import HomeProducts from '../components/HomeProducts.vue';
export default {
    name: 'Index',
    data() {
        return {
            homeBanners: [],
            homeBrands: [],
            homeCategories: [],
            homeProducts: [],
        }
    },
    components: {
        Layout,
        HomeBanner,
        HomeCategory,
        TrendingProducts,
        HomeProducts,
    },
    mounted() {
        this.getHomeData();
        var srcList = [
            '/front_assets/js/vendor/jquery-3.5.0.min.js', '/front_assets/js/popper.min.js', '/front_assets/js/bootstrap.min.js', '/front_assets/js/isotope.pkgd.min.js'
            , '/front_assets/js/imagesloaded.pkgd.min.js', '/front_assets/js/jquery.magnific-popup.min.js', '/front_assets/js/jquery.mCustomScrollbar.concat.min.js'
            , '/front_assets/js/bootstrap-datepicker.min.js', '/front_assets/js/jquery.nice-select.min.js', '/front_assets/js/jquery.countdown.min.js'
            , '/front_assets/js/swiper-bundle.min.js', '/front_assets/js/jarallax.min.js', '/front_assets/js/slick.min.js',
            '/front_assets/js/wow.min.js', '/front_assets/js/nav-tool.js', '/front_assets/js/plugins.js', '/front_assets/js/main.js'
        ];
        const loadScriptsSequentially = async () => {
            for (const src of srcList) {
                await new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = src;
                    script.async = false;
                    script.onload = () => resolve();
                    script.onerror = () => reject(`Failed to load ${src}`);
                    document.body.appendChild(script);
                });
            }

            // Call the global loadJS function AFTER all scripts are loaded
            if (typeof loadJS === 'function') {
                loadJS(); // safe to call now
            } else {
                console.error("loadJS is not defined");
            }
        };
        loadScriptsSequentially().catch(error => console.error(error));

    },

    methods: {
        async getHomeData() {
            const urls = getUrlList();

            try {
                const response = await axios.get(urls.getHomeData);
               // console.log(response.data.data);

                this.homeBanners = response.data.data.banners;
                this.homeBrands = response.data.data.brands;
                this.homeCategories = response.data.data.categories;
                this.homeProducts = response.data.data.products;

                // console.log(this.headerCatergories);


            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        }


    },

}
</script>
