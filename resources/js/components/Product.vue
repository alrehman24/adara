<template>
    <div :key="product.id" class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one"
        style="position: absolute; left: 25%; top: 0px;">
        <div class="new-arrival-item text-center mb-50">
            <div class="thumb mb-25">
                <div class="discount-tag">- 20%</div>
                <a href="shop-details.html"><img style="max-height: 400px;" :src="product.image" alt=""></a>
                <div class="product-overlay-action">
                    <ul>
                        <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <h5><a href="shop-details.html">{{ product.name }}</a></h5>
                <span class="price">{{ product.min_price }}</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Product',
    props: {
        product: Object,

    },

}
</script>
