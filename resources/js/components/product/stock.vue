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
                            Stock
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <!-- <th>Buy Price</th> -->
                                    <th>Status</th>
                                    <th>Quantity</th>
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
                                    <td>{{ product.category_name }}</td>
                                    <!-- <td>$ {{ product.buying_price }}</td> -->
                                    <!-- ---------------- -->
                                    <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Avaliable</span></td>
                                    <td v-else-if="product.product_quantity < 1"><span class="badge badge-danger">Stock Out</span></td>
                                    <td>{{ product.product_quantity }}</td>
                                    <!-- ---------------- -->
                                    <td>
                                        <router-link
                                            :to="{name: 'edit-stock', params: {id:product.id} }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </router-link>
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
