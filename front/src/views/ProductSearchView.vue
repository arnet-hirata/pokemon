<template>
    <div>
        <h1>商品検索</h1>
        <input 
        v-model="keyword"
        type="text"
        praceholder="商品名を入力"
        >
        <button @click="search">検索</button>

        <ul>
            <li
            v-for="product in products"
            :key="product.id"
            >
        {{  product.name }}
        ¥{{ product.price }}
        </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { searchProducts } from '@/utils/productApi'

const keyword = ref('')
const products = ref([])

const search = async () => {
    try{
    const response = await searchProducts(keyword.value)
    products.value = response.data
}catch(error){
console.error(error)
}
}
</script>