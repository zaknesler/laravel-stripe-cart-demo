<template>
    <div class="w-full">
        <div class="border rounded">
            <div class="border-b bg-grey-lightest rounded-t text-grey-darker font-semibold px-4 py-3">Products <span v-show="input" class="text-grey-dark font-normal">({{ filteredProducts.length }} matching search)</span></div>

            <div class="bg-white rounded-b p-4">
                <div class="max-w-sm mx-auto -mb-4">
                    <div class="mb-6">
                        <input autofocus required type="text" v-model="input" placeholder="Search products..." class="block appearance-none outline-none w-full h-full border focus:border-grey bg-grey-lightest text-grey-darker p-3 rounded" />
                    </div>

                    <div v-if="filteredProducts" v-for="product in filteredProducts" class="flex mb-4">
                        <img class="block w-16 h-16 select-none pointer-events-none" :src="product.image" alt="Product Image" />

                        <div class="ml-4">
                            <div class="text-grey-darkest font-semibold mb-2" v-text="product.name"></div>

                            <div class="text-grey-darker" v-text="'$' + (product.price / 100).format(2)"></div>
                        </div>

                        <div class="flex-1 text-right ml-4 self-center">
                            <a class="inline-block border hover:border-grey bg-grey-lightest rounded px-3 py-1 text-grey-darker no-underline" :href="'/products/' + product.id">View &rarr;</a>
                        </div>
                    </div>

                    <div v-else>No products found.</div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                input: '',
                products: []
            }
        },

        mounted() {
            axios.get('/api/products').then(({ data }) => this.products = data)
        },

        computed: {
            filteredProducts() {
                if (!this.products.length) {
                    return [];
                }

                return this.products.filter(product => {
                    return product.name.toLowerCase().includes(this.input.toLowerCase())
                })
            }
        }
    }
</script>
