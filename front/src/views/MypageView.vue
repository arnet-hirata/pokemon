<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { apiClient } from '@/utils/api.js'



const router = useRouter()

const formData = ref({
    name:'',
    email:'',
    tel:'',
    postal:'',
    address:'',
    name:'',
    pay_method:'',
    total_price:'',
    created_at:'',
})

const error = ref({})

const getUser = async()=>{
    try{
        const response = await apiClient.get('/mypage')
        
        formData.value.name = response.name
        formData.value.email = response.email
        formData.value.tel = response.tel
        formData.value.postal = response.postal
        formData.value.address = response.address
        formData.value.name = response.name
        formData.value.pay_method = response.pay_method
        formData.value.total_price = response.total_price
        formData.value.created_at = response.created_at

        console.log(response)
    }catch(error){
        console.error(error)
    }
}

const updateUser = async()=>{
    try{
        await apiClient.get('/user',formData.value)
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
    name:formData.value.name ,
    email:formData.value.email, 
    tel:formData.value.tel,    
    postal:formData.value.postal ,
    address:formData.value.address ,
    name:formData.value.name ,
    pau_method:formData.value.pay_method ,
    total_price:formData.value.total_price,
    created_at:formData.value.created_at,
    
  }
  console.log(registerData)
  try {
    const data = await apiClient.get(`/user/edit/${formData.value.id}`, registerData)
    
    
  } catch (error) {
    console.error('登録エラー:', error)
    
    
  } 
}
    
    
    // ページ読み込み時にトークンがあるかチェック
    onMounted(()=>{
        getUser()
    })


</script>
<template>
    <div>
        <h1>マイページ</h1>
        <section>
            <h2>ユーザー情報</h2>
            <div v-if="user">
                <div>
                    名前:{{ user.name }}
                </div>
                <div>
                    メールアドレス:{{ user.email }}
                </div>
                <div>
                    電話番号:{{ user.tel }}
                </div>
                <div>
                    郵便番号:{{ user.postal }}
                </div>
                
                <div>
                    <button @click="editPage">ユーザー情報を編集</button>
                </div>
            </div>
        </section>
        
        <section>
            <h2>購入履歴</h2>

            <div v-for="order in orders" :key="order.id">
                
                商品名:{{ order.name }}
                購入金額:{{ order.pay_method }}
                購入方法:{{ order.total_price }}
                購入日:{{ order.created_at }}
            </div>
            
        </section>

        <section>
            <button @click="handleLogout">
                ログアウトする
            </button>
        </section>

    </div>
</template>