
<script setup>
import { ref, onMounted } from 'vue'
import { apiClient } from '@/utils/api'

const keyword = ref('')
const products = ref([])
const quantities = ref({})
const loading = ref(false)

const search = async () => {

        // loading.value = true
        const response = await apiClient.get(`/products/search?name=${encodeURIComponent(keyword.value)}`)

        products.value = response.data || response

        //検索結果の商品の初期数量1
        products.value.forEach(product => {
            if(!quantities.value[product.id]) {
                quantities.value[product.id] = 1
            }
        })

}
const addToCartItem = async (productId) => {
    console.log(quantities.value[productId],productId)
            const response = await apiClient.post('/cart',{
                product_id: productId,
                quantity: quantities.value[productId]
            })
            const result = response.data || response
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
            
            <select v-model="quantities[product.id]">
                <option v-for="n in product.stock" :key="n" :value="n">
                {{ n }}個
            </option> </select>
        </td>
        <td>
            <button @click="addToCartItem(product.id)">カートに追加</button>
        </td>
    </tr>
</tbody>
        </table>
        <p v-else>検索結果がありません</p>
    </div>
</template>