import { defineStore } from "pinia";
export const userUserStore = defineStore("user", {
    state: () => ({
        user_info: {
            user_id: "",
            auth: false,
        }

    }),
    actions: {
        setUserInfo(userInfo) {
            this.user_info = userInfo;
        },
        updateAuthStatus(status){
            this.user_info.auth=status;
        },
        updateUserId(userId){
            this.user_info.user_id=userId;
        }

    },
    persist: true,
});
