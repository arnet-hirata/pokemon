
<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { apiClient } from '@/utils/api'

const router = useRouter()

const carts = ref([])

const totalPrice = computed(() => {
    return carts.value.reduce((sum, cart) => {
        return sum + (cart.product.price * cart.quantity)
    },0)
})

const getCart = async () => {

        const response = await apiClient.get(`/cart`)

        carts.value = response.data || response
        console.log(carts.value)
}

const order = () => {
    router.push('/order')
}

const removeCart = async (id) => {
    const response = await apiClient.delete(`/cart/${id}`)

    const data = response.data || response

    alert(data.message)

    getCart()
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
            
        <td><RouterLink :to="`/admin/products/${cart.product.id}`">
                    {{ cart.product.name }}
                    </RouterLink></td>
        <td>{{ cart.product.price }}円</td>
        <td>{{ cart.quantity }}個</td>
        <td>{{ cart.product.release_date }}</td>
        <td><p class="product-description">{{ cart.product.text }}</p></td>
        <td>{{ cart.product.price * cart.quantity }}円</td>
        <td><button @click="removeCart(cart.id)">削除</button></td>
    </tr>
</tbody>
        </table>

        <button v-if="carts.length"
        @click="order">購入画面へ</button>

        <p v-else>カートに商品がありません</p>
<h3 v-if="carts.length">合計: {{ totalPrice }}円</h3>
    </div>

</template>

<style>
.product-description{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>