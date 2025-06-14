<template>
    <section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="section-title title-style-two text-center mb-50">
                        <h3 class="title">Trending Products</h3>
                    </div>
                </div>
            </div>
            <div class="row no-gutters trending-product-grid">
                <div class="col-2">
                    <div class="trending-products-list">
                        <h5>Category </h5>

                        <ul class="nav nav-tabs" id="trendingTab" role="tablist">
                            <li v-for="(item, index) in this.$helpers.getShortArray(homeCategories, 5)" :key="item.id"
                                class="nav-item" role="presentation">
                                <a :class="{ 'nav-link': true, 'active': index === 0 }" :id="item.slug + '-cat-tab'"
                                    data-toggle="tab" :href="'#' + item.slug + '-cat'" role="tab"
                                    :aria-controls="'#' + item.slug + '-cat-tab'" aria-selected="true">{{
                                        item.name }}</a>
                            </li>

                        </ul>
                        <p class="offer"><a href="#">Limited-Time Offer!</a></p>
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content tp-tab-content" id="trendingTabContent">
                        <div v-for="(item, index) in this.$helpers.getShortArray(homeCategories, 5)" :key="item.id"
                            :class="{ 'tab-pane ': true, ' show active': index === 0 }" :id="item.slug + '-cat'"
                            role="tabpanel" :aria-labelledby="item.slug + '-cat-tab'">
                            <div class="trending-products-banner banner-animation">
                                <a href="shop-sidebar.html"><img src="/front_assets/img/images/trending_banner03.jpg"
                                        alt=""></a>
                            </div>
                            <div v-for="productitem in this.$helpers.getShortArray(item.products, 5)"
                                :key="productitem.id" class="row trending-product-active">
                                <div class="col">
                                    <div class="features-product-item">
                                        <div class="features-product-thumb">
                                            <div class="discount-tag">-20%</div>
                                            <a href="shop-details.html">
                                                <img :src="productitem.image" alt="">
                                            </a>
                                            <div class="product-overlay-action">
                                                <ul>
                                                    <li><a href="cart.html"><i class="far fa-heart"></i></a>
                                                    </li>
                                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="features-product-content">
                                            <div class="rating">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <h5><a href="shop-details.html">{{ productitem.name }}</a></h5>
                                            <p class="price">$67.00</p>
                                            <div class="features-product-bottom">
                                                <ul>
                                                    <li class="color-option">
                                                        <span class="gray"></span>
                                                        <span class="cyan"></span>
                                                        <span class="orange"></span>
                                                    </li>
                                                    <li class="limited-time"><a href="#">Limited-Time
                                                            Offer!</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="features-product-cart"><a href="javascript:void(0)" >add to
                                                cart</a>
                                        </div>
                                    </div>
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
    name: 'TrendingProducts',
    props: {
        homeCategories: Array
    }

}
</script>
