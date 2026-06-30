<script setup>
import { ref, onMounted } from 'vue'
import { apiClient } from '@/utils/api'
import { gethProducts } from '@/utils/productApi';
import { deleteProduct } from '@/utils/productApi';

const products = ref([]);

onMounted(async () => {
    const response = await gethProducts();
    products.value = response.data;
});

console.log(products.value);

const removeProduct = async(id) => {
    if(!confirm('この商品を削除しますか？')){
        return;
    }
    try{
        await deleteProduct(id);
        products.value = products.value.filter(
            product => product.id !== id);
        alert('削除しました');
    }catch(error){
        console.error(error);
        alert('削除に失敗しました');
    }
};
</script>

<template>
    <div>
        <div class="about">
            <h1>登録リスト</h1>
        </div>
        <RouterLink to="/admin/product/create">
            <button>商品登録</button>
        </RouterLink>
        
        <div>
            <table>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>カテゴリー名</th>
                    <th>販売日</th>
                    <th>在庫数</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                    <th>商品編集</th>
                    <th>商品削除</th>
                </tr>
            <tr v-for="product in products" :key="product.id">
                <td>
                    <RouterLink :to="`/admin/products/${product.id}`">
                    {{ product.name }}
                    </RouterLink>
                </td>
                <td>{{ product.price }}</td>
                <td>{{ product.category_name }}</td>
                <td>{{ product.release_date }}</td>
                <td>{{ product.stock }}</td>
                <td>{{ product.created_at}}</td>
                <td>{{ product.updated_at }}</td>
                <td><RouterLink :to="`/admin/products/${product.id}/edit`">編集
                </RouterLink></td>
                <td><button
                    @click="removeProduct(product.id)">削除
                </button></td>
            </tr>
            </table>
            </div>
        </div>
</template>

<style scoped>

table{
    border-collapse: collapse;
}

table,
th,
td{
    border: 1px solid gray;
}

th,
td{
    padding: 8px;
}

</style>