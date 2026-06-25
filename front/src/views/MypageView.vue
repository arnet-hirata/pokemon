<script setup>
    import { ref, reactive, onMounted } from 'vue'
    import { useRouter } from 'vue-router'
    import { apiClient } from '@/utils/api.js'

    const router = useRouter()

    const user = ref(null)
    const order= ref({})
    const User = async()=>{
        try{
            const response = await apiClient.get('/user')
            
            user.value = response.date
        }catch(error){
            console.error(error)
        }
    }

    const Order = async()=>{
        try{
            const response = await apiClient.get('/order')
            
            user.value = response.date
        }catch(error){
            console.error(error)
        }
    }

    const editPage =()=>{
        router.push('/user/edit')
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

        // フォームを再表示
        isLoggedIn.value = false
        formData.email = ''
        formData.password = ''
        showMessage('ログアウトしました', false)
    }
}

</script>
<template>
    <div>
        <h1>マイページ</h1>
        <section>
            <h2>ユーザー情報</h2>
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
        </section>
        
        <section>
            <h2>購入履歴</h2>

            <table v-if="order.user_id === user.id">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>購入金額</th>
                        <th>購入方法</th>
                        <th>購入日</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="order in orders" :key="order.id">
                        <td>
                            {{ order.product.name }}
                        </td>
                        <td>
                            {{ order.total_price }}
                        </td>
                        <td>
                            {{ order.pay_method }}
                        </td>
                        <td>
                            {{ order.order_details.created_at }}
                        </td>
                    </tr>
                </tbody>

            
            </table>
            <p v-else>
                購入履歴はありません
            </p>
        </section>

        <section>
            <button @click="handleLogout">
                ログアウトする
            </button>
        </section>

    </div>
</template>