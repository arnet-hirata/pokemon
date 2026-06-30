<script setup>
    import { ref, onMounted } from 'vue'
    import { apiClient } from '@/utils/api.js'
    import { getProduct } from '@/utils/productApi';

    const products = ref([])
    const loading = ref(true)
    const error = ref(null)

    const loadProducts = async () => {
    try {
        loading.value = true
        error.value = null
        const response = await apiClient.get('/products')
        products.value = response.data || response
        console.log(products)
    } catch (err) {
        console.error('データの取得に失敗:', err)
        error.value = 'データの取得に失敗しました'
    } finally {
        loading.value = false
    }
    }

    onMounted(() => {
    loadProducts()
    })
</script>
<template>
    <div class="list">
        <div class="about">
            <h2>新商品</h2>
        </div>
        <div class="product-container">
            <div v-for="product in products" :key="product.id" class="product-area">
                
                <div class="image-area">
                    <img
                    v-if="product.product_images.length > 0"
                    :src="`http://127.0.0.1:8000/storage/${product.product_images[0].path}`"
                    class="picture"
                    >                
                </div>
                
                <div>
                    {{ product.name }}
                </div>
                <div>
                    <p class="product-description">{{ product.text }}</p>
                </div>
                <div>
                    ￥{{ product.price }}
                </div>
                <div>
                    <RouterLink :to="`/products/productdetail/${product.id}`">
                    商品詳細へ
                    </RouterLink>
                </div>
            </div>
        </div>
        
    </div>
    <div>

    </div>
</template>


<style>
.list{
    width: 90%;
    margin: 0 auto;
}

h2{
    padding: 28px;
}
.product-container{
    display: flex;
    gap:16px;
    flex-wrap: wrap;
    justify-content: center;
}

.product-area{
    width: 250px;
    border: 1px solid #d6d6d6;
    padding: 10px;
    box-sizing: border-box;
}

.product-area img{
    width: 100%;
    height: 200%;
    object-fit: cover;
    
}

.product-description{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* .picture{
    width: 100%;
    height: 100%;
    object-fit: contain;
} */

</style>