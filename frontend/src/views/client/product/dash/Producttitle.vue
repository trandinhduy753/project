<script setup>
import { productClient } from '@/constant'
const fetchGetListProduct = async (category="", page=1, per_page=30) => {
    const result =await store.dispatch('client/product/' + productClient.get_list_product_by_type, {category, page, per_page})
}
const chooseCategory = (code, index) => {
    active_menu.value = index
    store.commit('client/product/CHANGE_CATEGORY', code)
    fetchGetListProduct(category.value, 1, 30)
}
const isVisible = ref(false);
var active_menu = ref(0);
const store = useStore();
const categories = computed(() => store.getters['client/product/get_categories'] );
const category = computed(() => store.state.client.product.category)
onMounted(() => {
  setTimeout(() => {
    isVisible.value = true;
  }, 500);

});

</script>

<template>
    <div class="col-span-12 animate-push-top-bot mt-7 ">
        <div class="text-4xl font-semibold font-serif text-center">
            <span class="text-center inline border-b-4 border-[var(--maincolor)] dark:border-blue-500 pb-2 dark:text-white">Featured Product</span>
        </div>
        <div class="mt-8">
            <ul class="flex justify-center">
                <li v-for="(category, index) in categories" :key="index"
                  
                    class="text-lg pb-1 px-6 text-slate-800 dark:text-gray-300 mr-8 cursor-pointer relative before:absolute before:bottom-0 before:left-0 before:w-full before:bg-[var(--maincolor)] dark:before:bg-blue-500 before:scale-x-0 before:origin-left before:transition-transform before:duration-500"
                    :class="active_menu == index ? 'border-[var(--maincolor)] border-b-4 dark:border-blue-500' : 'hover:before:scale-x-100 before:h-1'"
                    @click="chooseCategory(category.id, index)"
                    >
                    {{ category.name }}
                </li>
            </ul>
        </div>
    </div>
</template>
