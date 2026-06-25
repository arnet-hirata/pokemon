<script setup>
    import { ref, onMounted } from 'vue'
    import { apiClient } from '@/utils/api.js'

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
    <div>
        <div class="about">
            <h1>新商品</h1>
        </div>
        <div>
            <div v-for="product in products" :key="product.id">
                <div v-for="product_image in product.product_images" :key="product_image.id">
                    {{ product_image.path }}
                </div>
                <div>
                    {{ product.name }}
                </div>
                <div>
                    {{ product.text }}
                </div>
                <div>
                    ￥{{ product.price }}
                </div>
            </div>
        </div>
        <div>
            <button>
                新商品をもっと見る
            </button>
        </div>
    </div>
    <div>

    </div>
</template>