import { defineStore } from "pinia";
import axios from "axios";
import getUrlList from "../provider";
import { userUserStore } from "./userStore";
export const cartStore = defineStore("cart", {
    state: () => ({
        cartItems: [],
    }),
    actions: {
        async addToCart(product_id, product_attr_id, quantity) {
            const userStore = userUserStore();
            console.log(userStore.user_info.token);
            const response = await axios.post(getUrlList().addToCart, {
                token: userStore.user_info.user_id,
                product_id: product_id,
                product_attr_id: product_attr_id,
                qty: quantity,
            });
            //  console.log(response.data);
            if (response.status === 200) {
                await this.getCartData();
            } else {
                console.error(response.message);
            }
        },
        async getCartData() {
            const userStore = userUserStore();
            const response = await axios.post(getUrlList().getCartData, {
                token: userStore.user_info.user_id,
            });
            if (response.status === 200) {
                this.cartItems = response.data.data;
            } else {
                console.error(response.message);
            }
        },
        async removeCartItem(cart_id) {
            const userStore = userUserStore();
            const response = await axios.post(getUrlList().removeCartItem, {
                token: userStore.user_info.user_id,
                cart_id: cart_id,
            });
            if (response.status === 200) {
                await this.getCartData();
            } else {
                console.error(response.message);
            }
        },
    },
    persist: true,
});
