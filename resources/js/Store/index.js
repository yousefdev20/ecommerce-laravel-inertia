import { createStore } from 'vuex'
// import {notify} from "@kyvg/vue3-notification";
export default createStore({
    state: {
        total: 0,
        cart: []
    },
    getters: {
        guard(state, name) {
            return !!state[name]?.token
        }
    },
    mutations: {
        AddToCart(state, item) {
            const i = state.cart.map(item => item.id).indexOf(item.id);
            if (i >= 0) {
                state.cart[i].quantity += 1;
            } else {
                item.quantity = 1;
                state.cart.push(item);
            }
        },
        RemoveItem(state, id) {
            const i = state.cart.map(item => item.id).indexOf(id);
            state.cart.splice(i, 1);
            state.total -= 1;
        }
    },
    actions: {
    },
    modules: {
    }
})
