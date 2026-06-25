
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
console.log(response)

        products.value = response.data || response
    }catch (error) {
        console.error(error)
    }finally{
        loading.value = false
    }
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
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="product in products"
            :key="product.id"
            >
        <td>{{  product.name }}</td>
        <td>{{ product.price }}</td>
    </tr>
</tbody>
        </table>
        <p v-else>検索結果がありません</p>
    </div>
</template>