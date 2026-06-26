
<script setup>
import { ref, onMounted, computed } from 'vue'
import { apiClient } from '@/utils/api'

const carts = ref([])

const totalPrice = computed(() => {
    return carts.value.reduce((sum, cart) => {
        return sum + (cart.product.price * cart.quantity)
    },0)
})

const getCart = async () => {

        const response = await apiClient.get(`/cart`)

        carts.value = response.data || response
}

    onMounted(() => {
        getCart()
    })
</script>

<template>
    <div>
        <h1>カート</h1>

        <table v-if="carts.length">

        
        <thead>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>個数</th>
                <th>販売日</th>
                <th>説明欄</th>
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
        <td>{{ cart.product.release_date }}</td>
        <td>{{ cart.product.text }}</td>
        <td>{{ cart.product.price * cart.quantity }}円</td>
    </tr>
</tbody>
        </table>
        
        <p v-else>カートに商品がありません</p>
<h3 v-if="carts.length">合計: {{ totalPrice }}円</h3>
    </div>

</template>