<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/product"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">All Product</span>
        </router-link>
      </div>
    </div>

    <div class="row justify-content-center my-2">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 pb-4">Add Product</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="productInsert"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name, Code, Root -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-4">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="product_name"
                            >Product Name</label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="product_name"
                            placeholder="Enter Your Product Name"
                            v-model="form.product_name"
                          />
                        </div>
                        <!-- Code -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="product_code"
                            >Product Code</label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="product_code"
                            placeholder="Enter Your Product Code"
                            v-model="form.product_code"
                          />
                        </div>
                        <!-- Root -->
                        <div class="col-3">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="root"
                            >Root</label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="root"
                            placeholder="Enter Root"
                            v-model="form.root"
                          />
                        </div>
                      </div>
                    </div>

                    <!-- 02 | Category_id, Supplier ID -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Supplier -->
                        <div class="col-4">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="selectSupp"
                            >Product Supplier</label
                          >
                          <select
                            class="form-control form-control-sm"
                            id="selectSupp"
                            v-model="form.supplier_id"
                          >
                            <option
                              :value="supplier.id"
                              v-for="supplier, key in suppliers"
                              :key="key"
                            >
                              {{ supplier.name }}
                            </option>
                          </select>
                        </div>
                        <!-- Category -->
                        <div class="col-3 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="selectCat"
                            >Product Category</label
                          >
                          <select
                            class="form-control form-control-sm"
                            id="selectCat"
                            v-model="form.category_id"
                          >
                            <option
                              :value="category.id"
                              v-for="category, key in categories"
                              :key="key"
                            >
                              {{ category.category_name }}
                            </option>
                          </select>
                        </div>
                        <!-- Product Quantity -->
                        <div class="col-3 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="quantity"
                            >Quantity</label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="quantity"
                            placeholder="Enter Product Quantity"
                            v-model="form.product_quantity"
                          />
                        </div>
                      </div>
                    </div>

                    <!-- 03 | Buying Price, Selling Price, Buying Date -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Buying Price -->
                        <div class="col-3">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_price"
                            >Buying Price</label
                          >
                          <input
                            type="number"
                            class="form-control form-control-sm"
                            id="buying_price"
                            placeholder="Enter Buying Price"
                            v-model="form.buying_price"
                          />
                        </div>
                        <!-- Selling Price -->
                        <div class="col-3 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="selling_price"
                            >Selling Price</label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="selling_price"
                            placeholder="Enter Selling Price"
                            v-model="form.selling_price"
                          />
                        </div>
                        <!-- Buying Date -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_date"
                            >Buying Date</label
                          >
                          <input
                            type="date"
                            class="form-control form-control-sm"
                            id="buying_date"
                            v-model="form.buying_date"
                          />
                        </div>
                      </div>
                    </div>

                    <!--  04 | Photo -->
                    <div class="form-group mt-5">
                      <div class="form-row">
                        <div class="col-6">
                          <div class="custom-file">
                            <input
                              type="file"
                              id="customFile"
                              class="custom-file-input form-control-sm"
                              @change="onFileSelected"
                            />
                            <label
                              class="custom-file-label col-form-label-sm"
                              for="custmFile"
                              >Choose Photo</label
                            >
                          </div>
                        </div>
                        <div class="col-5 m-1">
                          <img
                            :src="form.image"
                            style="height: 30px; width: 50px"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="justify-content-end form-row">
                        <div class="col-3 mt-5">
                          <button
                            type="submit"
                            class="
                              btn btn-info btn-sm btn-icon-split
                              font-weight-bold
                              float-right
                            "
                          >
                            <span class="text">Create</span>
                            <span class="icon text-white-50">
                              <i class="fas fa-arrow-right"></i>
                            </span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      form: {
        category_id: null,
        product_name: null,
        product_code: null,
        root: null,
        buying_price: null,
        selling_price: null,
        supplier_id: null,
        buying_date: null,
        image: null,
        product_quantity: null,
      },

      errors: {},

      categories: {},

      suppliers: {},
    };
  },

  methods: {
    onFileSelected(e) {
      // Imagem ao Lado do Input form.photo
      let file = e.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.form.image = e.target.result;
          // console.log(this.form.photo)
        };

        reader.readAsDataURL(file);
      }
      // console.log(files)
    },
    productInsert() {
      // crud - Create
      let url = "api/product";

      axios
        .post(url, this.form)
        .then((response) => {
          console.log(response);

          this.$router.push({ name: "product" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
  created() {
    // Select Categories/Suppliers
    let url_category = "/api/category/";
    axios.get(url_category).then(({ data }) => (this.categories = data));

    // ---------

    let url_supplier = "/api/supplier/";
    axios.get(url_supplier).then(({ data }) => (this.suppliers = data));
  },
};
</script>
