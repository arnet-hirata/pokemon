<script setup>
import { ref, onMounted } from 'vue'
import { apiClient } from '@/utils/api'
import { useRoute } from 'vue-router' 
const route = useRoute() 
console.log(route.params.id)

const orderData = ref({})

const getPurchase = async()=>{
    const response = await apiClient.get(`/order/detail/${route.params.id}`)
    console.log(response)
    try{
        // const response = await apiClient.get('/mypage')
        
        // orderData.value.name = response.data[0].name
        // orderData.value.price = response.data[0].price
        // orderData.value.quantity = response.data[0].quantity
        // orderData.value.pay_method= response.data[0].pay_method
        // orderData.value.created_at = response.data[0].created_at
        orderData.value = response.data[0].order_details
        
    }catch(error){
        console.log(error)
    }
}


onMounted(()=>{
    getPurchase()
})

console.log(orderData.value);

</script>

<template>
    <div>
        <div class="about">
            <h1>注文詳細</h1>
        </div>
        <div>
            <table>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>個数</th>
                    <th>購入日時</th>
                </tr>
            <tr v-for="order in orderData" :key="order.id">
                <td>{{ order.product.name }}</td>
                <td>{{ order.product.price }}</td>
                <td>{{ order.quantity }}</td>
                <td>{{ order.created_at }}</td>
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