<script setup>
import { ref} from 'vue'
import { apiClient } from '@/utils/api'
import { createProduct } from '@/utils/productApi';
import { useRouter } from 'vue-router';

const product = ref({
    name:'',
    category_id:'',
    price:'',
    stock:'',
    release_date:'',
    text:'',
    product_images:[]
});

        const router = useRouter();

        const selectImages = (event) => {
    product.value.product_images = [...event.target.files];
};

const submit = async() => {
    try{
    const formData = new FormData();

    formData.append('name',product.value.name);
    formData.append('category_id',product.value.category_id);
    formData.append('price',product.value.price);
    formData.append('stock',product.value.stock);
    formData.append('release_date',product.value.release_date);
    formData.append('text',product.value.text);

    product.value.product_images.forEach(image => {
        formData.append('product_images[]',image)

    })
        await createProduct(formData);
        router.push('/admin/products');
    }catch(error){
        console.error(error);
        if(error.response){
            console.log(error.response.data);
        }
        alert('商品登録に失敗しました');
    }
};


</script>

<template>
    <div>
    <h1>商品登録</h1>
    </div>

    <form @submit.prevent="submit">
        <div>
            <label>商品名</label>
            <input
            type="text"
            v-model="product.name"
            >
        </div>

        <div>
            <label>価格</label>
            <input
            type="number"
            v-model="product.price"
            >
        </div>

        <div>
            <label>カテゴリー</label>
            <select v-model="product.category_id">
                <option value="">選択してください</option>
                <option value="1">おもちゃ・ぬいぐるみ</option>
                <option value="2">ゲーム</option>
                <option value="3">ポケモンカードゲーム</option>
                <option value="4">雑貨・小物</option>
                <option value="5">文房具</option>
                <option value="6">スマホ・PC用品</option>
                <option value="7">生活雑貨</option>
                <option value="8">アパレル・服</option>
                <option value="9">バック・ポーチ</option>
                <option value="10">お菓子・食品</option>
            </select>
        </div>

        <div>
            <label>在庫数</label>
            <input
            type="number"
            v-model="product.stock"
            >
        </div>

        <div>
            <label>販売日</label>
            <input
            type="date"
            v-model="product.release_date"
            >
        </div>

        <div>
            <label>商品説明</label>
            <textarea
            v-model="product.text"
            rows="5"
            ></textarea>
        </div>

        <div>
            <label>商品画像</label>
            <input
            type="file"
            multiple
            @change="selectImages"
            >
        </div>

        <button
        type="submit"
        >
        登録
    </button>
    </form>

</template>

