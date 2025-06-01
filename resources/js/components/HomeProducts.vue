<template>
     <section class="new-arrival-area pt-95 pb-45">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-4 col-lg-6">
                                <div class="section-title title-style-two text-center mb-45">
                                    <h3 class="title">New Arrival Collection</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="new-arrival-nav mb-35">
                                    <button class="active" data-filter="*">Best Sellers</button>
                                    <button class="" data-filter=".cat-one">New Products</button>
                                    <button class="" data-filter=".cat-two">Sales Products</button>
                                </div>
                            </div>
                        </div>
                        <div class="row new-arrival-active" style="position: relative; height: 934.032px;">

                            <Product v-for="(product, index) in homeProducts" :key="index" :product="product" />


                        </div>
                    </div>
                </section>
</template>
<script>
import Product from './Product.vue';
    export default{
        name: 'HomeProducts',
        props:{
            homeProducts: Array
        },
        components: {
            Product
        }
    }
</script>
