<!-- <script setup>
import {ref} from 'vue';
import { useRoute } from 'vue-router';
import { changeStock } from '@/utils/productApi';

const route = useRoute();
const stock = ref({
    change_Stock:'',
    reason:''
});

const submit = async() => {
    try{
        await changeStock(
            route.params.id,
            stock.value
        );

        alert('在庫を更新しました');
        stock.value.change_Stock='';
        stock.value.reason='';
    }catch(error){
        console.error(error);
    };
    
}
</script> -->