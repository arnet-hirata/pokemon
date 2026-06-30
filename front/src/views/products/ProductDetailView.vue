<script setup>
import {ref,onMounted} from 'vue';
import { useRoute,useRouter } from 'vue-router';
import { getProductDetail } from '@/utils/productApi';
import { apiClient } from '@/utils/api'


const route = useRoute();
const product = ref(null);
const quantity = ref()
const router = useRouter()

// onMounted(async () => {
//     try{
//     const response = await getProduct(route.params.id);
//     console.log(response);
//     product.value = response.data;
//     }catch (error){
//         console.error(error);
//         // console.log(error.response);
//         // alert('商品情報の取得に失敗しました');
//     }
// });

const addToCartItem = async (productId) => {
            const response = await apiClient.post('/cart',{
                product_id: productId,
                quantity: quantity.value
            })
            const result = response.data || response

            router.push('/cart');
}
onMounted(async () => {

try{

const response = await getProductDetail(route.params.id);
console.log(response);
product.value = response.data;

quantity.value = 1
    
}catch (error){
    console.error(error);
    // console.log(error.response);
    // alert('商品情報の取得に失敗しました');
}

})

</script>

<template>
    <div v-if="product">
    <h1>商品詳細</h1>

    <div>
        <p><strong>商品名：</strong>{{ product.name }}</p>
    </div>
    <div>
        <p><strong>カテゴリー：</strong>{{ product.category_name }}</p>
    </div>
    <div>
        <p><strong>価格：</strong>{{ product.price }}</p>
    </div>
    <div>
        <p><strong>在庫数：</strong>{{ product.stock }}</p>
    </div>
    <div>
        <p><strong>販売日：</strong>{{ product.release_date }}</p>
    </div>
    <div>
        <p><strong>商品説明：</strong></p>
        <p>{{ product.text }}</p>
    </div>
        <div>
        <h3>商品画像</h3>

        <div v-for="image in product.product_images" :key="image.id">
            <img :src="`http://127.0.0.1:8000/storage/${image.path}`"
            width="200">
        </div>
        
        </div>
        <div>
            <select v-model="quantity">
                <option v-for="n in product.stock" :key="n" :value="n">
                {{ n }}個
                </option> 
            </select>
        </div>
        <div>
            <button @click="addToCartItem(product.id)">カートに追加</button>
        </div>
    </div>

</template>

<style scoped>
img{
    margin:10px;
}
</style>