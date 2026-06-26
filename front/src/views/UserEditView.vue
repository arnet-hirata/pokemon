<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { apiClient } from '@/utils/api.js'



const router = useRouter()

const formData = ref({
    id:'',
    name:'',
    email:'',
    tel:'',
    postal:'',
    address:'',
    password:'',
})

const error = ref({})

const editUser = async()=>{
    try{
        const response = await apiClient.get('/user')
        
        formData.value.id = response.id
        formData.value.name = response.name
        formData.value.email = response.email
        formData.value.tel = response.tel
        formData.value.postal = response.postal
        formData.value.address = response.address
        formData.value.password = response.password


    }catch(error){
        console.error(error)
    }
}

const updateUser = async()=>{
    try{
        await apiClient.put('/user',formData.value)
        alert('ユーザー情報を更新しました')

        router.push('/mypage')
    }catch(error){
        if(error.response?.status=== 442){
            errors.value = error.response.data.errors
        }

        console.error(error)
    }
}

const handleSubmit = async () => {
//   if (!validatePasswords()) {
//     return
//   }


//   isLoading.value = true

  const registerData = {
    name: formData.value.name,
    email: formData.value.email,
    tel: formData.value.tel,
    postal: formData.value.postal,
    address: formData.value.address,
    password: formData.value.password
    
  }
  console.log(registerData)
  try {
    const data = await apiClient.put(`/user/edit/${formData.value.id}`, registerData)
    
    
  } catch (error) {
    console.error('登録エラー:', error)
    
    
  } 
}
const goTop = async () => {
    router.push('/products/index')
}
onMounted(()=>{
    editUser()
})
</script>
<template>
<div>
    <h1>お客様情報登録・編集</h1>
    <form @submit.prevent="handleSubmit">
        <div>
            <label>名前</label>
            <input type="text" v-model="formData.name">
        </div>
        <div>
            <label>メールアドレス</label>
            <input type="email" v-model="formData.email">
        </div>
        <div>
            <label>電話番号</label>
            <input type="text" v-model="formData.tel">
        </div>
        <h2>住所登録</h2>
        <div>
            <label>郵便番号</label>
            <input type="text" v-model="formData.postal">
        </div>
        <div>
            <label>住所</label>
            <input type="text" v-model="formData.address">
        </div>


        <div>
            <label>パスワード</label>
            <input type="password" v-model="formData.password">
        </div>
        <div>
            <button>保存する</button>
        </div>
        
    </form>
    <div>
        <button @click="goTop()">トップページへ</button>
    </div>
</div>
</template>