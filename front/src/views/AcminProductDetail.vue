<script setup>
import {ref,onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { gethProduct } from '@/utils/productApi';

const route = useRoute();
const product = ref(null);

onMounted(async () => {
    const response = await gethProduct(route.params.id);
    product.value = response.data;
});

</script>

<template>
    <h1>商品詳細</h1>
</template>