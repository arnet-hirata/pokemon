<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { apiClient } from '@/utils/api.js'



const router = useRouter()


const userData = ref({
    name:'',
    email:'',
    tel:'',
    postal:'',
    address:'',
    
})
const orderData = ref({})

const error = ref({})

const getUser = async()=>{
    const response = await apiClient.get('/mypage')
    try{
        // const response = await apiClient.get('/mypage')
        
        userData.value.name = response.data[0].name
        userData.value.email = response.data[0].email
        userData.value.tel = response.data[0].tel
        userData.value.postal = response.data[0].postal
        userData.value.address = response.data[0].address
        orderData.value = response.data[0].orders

        console.log(response)
    }catch(error){
        console.error(error)
        console.log(response)
    }
}

const handleLogout = async () => {
  try {
    // APIでログアウト
    await apiClient.post('/logout', {})
  } catch (error) {
    console.error('ログアウトAPIエラー:', error)
  } finally {
    // ローカルストレージをクリア
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    router.push('/login')
    // フォームを再表示
    isLoggedIn.value = false
    formData.email = ''
    formData.password = ''
    
    showMessage('ログアウトしました', false)
    
    
  }
  router.push('/login')
}
        
const editPage = async () => {
    router.push('/user/edit')
}

const purchaseHistory = async (orderId) => {
    router.push(`/order/detail/${orderId}`)
}

// ページ読み込み時にトークンがあるかチェック
onMounted(()=>{
    getUser()
})


</script>
<template>
    <div v-if="userData">
        <h1>マイページ</h1>
        <section>
            <h2>ユーザー情報</h2>
            <div >
                <div>
                    名前:{{ userData.name }}
                </div>
                <div>
                    メールアドレス:{{ userData.email }}
                </div>
                <div>
                    電話番号:{{ userData.tel }}
                </div>
                <div>
                    郵便番号:{{ userData.postal }}
                </div>
                <div>
                    住所:{{ userData.address }}
                </div>
                <div>
                    <button @click="editPage()">ユーザー情報を編集</button>
                </div>
            </div>
        </section>
        
        <section>
            <h2>購入履歴</h2>

            <div v-for="order in orderData" :key="order.order_id">
                
                商品名:{{ order.name }}
                購入金額:{{ order.pay_method }}
                購入方法:{{ order.total_price }}
                購入日:{{ order.created_at }}

                <div>
                    <button @click="purchaseHistory(order.order_id)">購入履歴の確認</button>
                </div>
            </div>
            
        </section>

        <section>
            <button @click="handleLogout">
                ログアウトする
            </button>
        </section>

    </div>
    
</template>