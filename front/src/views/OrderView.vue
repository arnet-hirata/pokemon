<script setup>
import { ref, onMounted, computed } from 'vue'
import { apiClient } from '@/utils/api'
import { useRouter } from 'vue-router'

const user = ref({})
const carts = ref([])
const paymentMethod = ref('paypay')
const router = useRouter();

const loadOrder = async() => {
    const response = await apiClient.get('/order')
    const data = response.data || response

    user.value = data.user
    carts.value = data.carts
}

const totalPrice = computed(() => {
    return carts.value.reduce((sum, cart) => {
        return sum + (cart.product.price * cart.quantity)
    },0)
})

const order = async () => {

        const response = await apiClient.post(`/order`,{
            pay_method: paymentMethod.value
        })
        const data = response.data || response
        alert(data.message)

        router.push('/mypage')
        
}

    onMounted(() => {
        loadOrder()
    })
</script>

<template>
    <div>
        <h1>購入画面</h1>
        <p>名前: {{ user.name }}</p>
        <p>お届け先: {{ user.address }}</p>

        <table border="1">
        
        <thead>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>個数</th>
                <th>小計</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="cart in carts"
            :key="cart.id"
            >
        <td>{{ cart.product.name }}</td>
        <td>{{ cart.product.price }}円</td>
        <td>{{ cart.quantity }}個</td>
        <td>{{ cart.product.price * cart.quantity }}円</td>
    </tr>
</tbody>
        </table>

        <h2>合計: {{ totalPrice }}円</h2>

        <h2>支払方法</h2>
        <select v-model="paymentMethod">
            <option value="paypay">PayPay</option>
            <option value="credit">クレジットカード</option>
            </select>
        <button 
        @click="order">購入する</button>
    </div>

</template>