<template>
    <li class="header-shop-cart"><a href="#"><i class="flaticon-shopping-bag"></i><span>{{ cartItem.length }}</span></a>
        <ul class="minicart">
            <li v-for="item in cartItem" :key="item.id" class="d-flex align-items-start">
                <div class="cart-img">
                    <a href="#"><img src="/front_assets/img/product/cart_p01.jpg" alt=""></a>
                </div>
                <div class="cart-content">
                    <h4><a href="#">{{ item.qty }}-{{ item.product.name }}</a></h4>
                    <div class="cart-price">
                        <span class="new">${{ item.product_attr.price * item.qty }}</span>
                        <span><del>${{ item.product_attr.price * item.qty }}</del></span>
                    </div>
                </div>
                <div class="del-icon">
                    <a href="javascript:void(0);" @click="removeCartItem(item.id)"><i class="far fa-trash-alt"></i></a>
                </div>
            </li>

            <li>
                <div class="total-price">
                    <span class="f-left">Total:</span>
                    <span class="f-right">${{ cartTotal.toFixed(2) }}</span>
                </div>
            </li>
            <li>
                <div class="checkout-link">
                    <a href="#">Shopping Cart</a>
                    <a class="black-color" href="#">Checkout</a>
                </div>
            </li>
        </ul>
    </li>
</template>
<script>
import { cartStore } from '../stores/cartStore';
export default {
    name: 'HeaderCart',
    data() {
        return {
            cart: null,
        }
    },
    computed: {
        cartItem() {
            //  console.log(this.cart.cartItems);
            return this.cart.cartItems;
        },
        cartTotal() {
            // Calculate grand total from cart items
            return this.cartItem.reduce((total, item) => {
                return total + (item.product_attr.price * item.qty);
            }, 0);
        }
    },
    methods: {
        removeCartItem(item_id) {
            this.cart.removeCartItem(item_id);
        },
    },
    created() {
        this.cart = cartStore();

    }
}
</script>
