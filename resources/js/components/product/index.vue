<template>
    <div>
        <div class="row justify-content-between mb-3 mt-5">
            <div class="col-6">
                <router-link
                    to="/store-product"
                    class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-marker"></i>
                    </span>
                    <span class="text">New Product</span>
                </router-link>
            </div>
            <div class="col-3">
                <input
                    v-model="searchTerm"
                    class="form-control form-control-sm float-right"
                    type="text"
                    placeholder="Search Product Code"
                />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 my-2">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            List Products
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <!-- <th>Suplier</th> -->
                                    <th>Category</th>
                                    <th>Buy Price</th>
                                    <!-- <th>Sell Price</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="product in filtersearch"
                                    :key="product.id"
                                >
                                    <td>{{ product.product_name }}</td>
                                    <td>
                                        <img
                                            :src="product.image"
                                            style="height: 40px; width: 40px; border-radius: 50%"
                                        />
                                    </td>
                                    <td>{{ product.product_code }}</td>
                                    <!-- <td>{{ product.name }}</td> -->
                                    <td>{{ product.category_name }}</td>
                                    <td>$ {{ product.buying_price }}</td>
                                    <!-- <td>$ {{ product.selling_price }}</td> -->
                                    
                                    <td>
                                        <router-link
                                            :to="{name: 'edit-product', params: {id:product.id} }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </router-link>
                                        <a
                                            @click="deleteProduct(product.id)"
                                            class="btn btn-danger btn-sm text-white"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
</template>

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },

    data() {
        return {
            products: [],
            searchTerm: ""
        }
    },

    methods: {
        allProduct() {
            // crud - read
            let url = 'api/product'
            
            axios.get(url)
                .then(({data}) => (
                    this.products = data
                ))
                .catch()
        },

        deleteProduct(id) {
            // crud - delete
            let url = 'api/product/' + id

            // alert
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"

            }) 
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete(url)
                        .then(() => {
                            this.products = this.products.filter(product => {
                                return product.id != id;
                            })
                        })
                        .catch(() => {
                            this.$route.push({ name: 'product' })
                        })
                    
                    Notification.delete()
                }
            })
        }
    },

    computed: {
      filtersearch() {
          return this.products.filter(product => {
              return product.product_code.match(this.searchTerm);
          })
      }  
    },

    mounted() {
        this.allProduct(); // crud - Read
    }
};

</script>
