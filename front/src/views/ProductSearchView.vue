
<script setup>
import { ref, onMounted } from 'vue'
import { apiClient } from '@/utils/api'

const keyword = ref('')
const products = ref([])
const loading = ref(false)

const search = async () => {
    try{
        loading.value = true
        const response = await apiClient.get(`/products/search?name=${encodeURIComponent(keyword.value)}`)

        products.value = response.data || response


    }catch (error) {
        console.error(error)
    }finally{
        loading.value = false
    }
}
const addToCartItem = async (productId) => {
            const result = await apiClient.post('/cart',{
                product_id: productId
            })
        }
    onMounted(() => {
        search()
    })
</script>

<template>
    <div>
        <h1>商品検索</h1>
        <input 
        v-model="keyword"
        type="text"
        placeholder="商品名を入力"
        />
        <button @click="search">検索</button>

        <div v-if="loading">読み込み中</div>

        <table v-else-if="products.length">
        <thead>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>販売日</th>
                <th>説明欄</th>
                <th>在庫数</th>
                <th>購入</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="product in products"
            :key="product.id"
            >
        <td>{{ product.name }}</td>
        <td>{{ product.price }}</td>
        <td>{{ product.release_date }}</td>
        <td>{{ product.text }}</td>
        <td>{{ product.stock }}</td>
        <td>
            <button @click="addToCartItem(product.id)">カートに追加</button>
        </td>
    </tr>
</tbody>
        </table>
        <p v-else>検索結果がありません</p>
    </div>
</template>