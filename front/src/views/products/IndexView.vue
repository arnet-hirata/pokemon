<script setup>
    
</script>
<template>
    <div>
        <div class="about">
            <h1>新商品</h1>
        </div>
        <div>
            <div>
                <div v-for="product_image in product_images" :key="product_image.id">
                    {{ product_image.path }}
                </div>
                <div v-for="product in products" :key="product.id">
                    {{ product.name }}
                </div>
                <div v-for="product in products" :key="product.id">
                    {{ product.text }}
                </div>
                <div v-for="product in products" :key="product.id">
                    {{ product.price }}
                </div>
            </div>
        </div>
        <div>
            <button>

            </button>
        </div>
    </div>
    <div>

    </div>
</template>