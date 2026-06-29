<script setup>
import {ref,onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { getProduct } from '@/utils/productApi';

const route = useRoute();
const product = ref(null);

onMounted(async () => {
    try{
    const response = await getProduct(route.params.id);
    console.log(response);
    product.value = response.data;
    }catch (error){
        console.error(error);
        // console.log(error.response);
        // alert('商品情報の取得に失敗しました');
    }
});

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

    </div>

</template>

<style scoped>
img{
    margin:10px;
}
</style>