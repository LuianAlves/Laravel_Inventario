<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">POS</li>
      </ol>
    </div>

    <div class="row">
      <!-- Products Sold -->
      <div class="col-12">
        <div class="card mb-4">
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
            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
          </div>
          <nav>
            <!-- Category Tabs -->
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="nav-home-tab"
                  data-toggle="tab"
                  href="#nav-home"
                  role="tab"
                  aria-controls="nav-home"
                  aria-selected="true"
                  >All Products</a
                >
              </li>
              <li
                class="nav-item"
                v-for="category in categories"
                :key="category.id"
              >
                <a
                  class="nav-link"
                  id="nav-profile-tab"
                  data-toggle="tab"
                  href="#nav-profile"
                  role="tab"
                  aria-controls="nav-profile"
                  aria-selected="false"
                  @click="subproduct(category.id)"
                  >{{ category.category_name }}</a
                >
              </li>
            </ul>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <!-- All Products Tab -->
            <div
              class="tab-pane fade show active"
              id="nav-home"
              role="tabpanel"
              aria-labelledby="nav-home-tab"
            >
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-xl-3 col-7">
                    <input
                      v-model="searchTerm"
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="Search Product Name"
                    />
                  </div>
                </div>
                <div class="row">
                  <div
                    class="col-3"
                    v-for="product in filtersearch"
                    :key="product.id"
                  >
                    <button
                      class="btn btn-sm"
                      @click.prevent="addCart(product.id)"
                    >
                      <div class="card mb-1" id="card-prod">
                        <div class="card-header">
                          {{ product.product_name }}
                        </div>
                        <img
                          :src="product.image"
                          id="em_photo"
                          class="card-img-top m-2"
                        />
                        <div class="card-body">
                          <p class="card-title">
                            {{ product.product_code }}
                          </p>
                          <span
                            class="badge badge-success"
                            v-if="product.product_quantity >= 1"
                            >Avaliable ({{ product.product_quantity }})</span
                          >
                          <span
                            class="badge badge-danger"
                            v-else-if="product.product_quantity < 1"
                            >Stock Out</span
                          >
                        </div>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Selected Category Tabs -->
            <div
              class="tab-pane fade"
              id="nav-profile"
              role="tabpanel"
              aria-labelledby="nav-profile-tab"
            >
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-7">
                    <input
                      v-model="getsearchTerm"
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="Search Product Name"
                    />
                  </div>
                </div>
                <div class="row">
                  <div
                    class="col-6"
                    v-for="getproduct in getfiltersearch"
                    :key="getproduct.id"
                  >
                    <button
                      class="btn btn-sm"
                      @click.prevent="addCart(getproduct.id)"
                    >
                      <div class="card mb-1" id="card-prod">
                        <div class="card-header">
                          {{ getproduct.product_name }}
                        </div>
                        <img
                          :src="getproduct.image"
                          id="em_photo"
                          class="card-img-top m-2"
                        />
                        <div class="card-body">
                          <p class="card-title">
                            {{ getproduct.product_code }}
                          </p>
                          <span
                            class="badge badge-success pos-badge"
                            v-if="getproduct.product_quantity >= 1"
                            >Avaliable ({{ getproduct.product_quantity }})</span
                          >
                          <span
                            class="badge badge-danger pos-badge"
                            v-else-if="getproduct.product_quantity < 1"
                            >Stock Out</span
                          >
                        </div>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Category Tabs !END -->
        </div>
      </div>
    </div>
    <!-- Carrinho -->
    <div class="row mb-3">
      <!-- Expense Insert  -->
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <div class="card mb-4">
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
                  Expense Insert
                </h6>
                <a
                  href="#"
                  class="
                    btn btn-primary btn-sm btn-icon-split
                    font-weight-bold
                    text-white
                  "
                >
                  <span class="icon text-white-50">
                    <i class="fas fa-marker"></i>
                  </span>
                  <span class="text">Add Customer</span>
                </a>
              </div>
              <div class="card-body">
                <form class="mt-4" @submit.prevent="orderdone">
                  <!-- Customer Name -->
                  <div class="form-group">
                    <div class="col-12">
                      <div class="row">
                        <label>Customer Name</label>
                        <select
                          class="form-control form-control-sm"
                          v-model="customer_id"
                        >
                          <option
                            :value="customer.id"
                            v-for="(customer, key) in customers"
                            :key="key"
                          >
                            {{ customer.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- Pay, Due -->
                  <div class="form-group mt-3">
                    <div class="row">
                      <!-- Pay | PAGOU-->
                      <div class="col-6">
                        <label>Pay</label>
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          placeholder="Pay Value"
                          v-model="pay"
                        />
                      </div>
                      <!-- Due | DEVE -->
                      <div class="col-6">
                        <label>Due</label>
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          placeholder="Due Value"
                          v-model="due"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="form-group mt-3">
                    <div class="row">
                      <!-- Payment -->
                      <div class="col-12">
                        <label>Payment Method</label>
                        <select
                          class="form-control form-control-sm"
                          v-model="payby"
                        >
                          <option value="Credit Card">Credit Card</option>
                          <option value="Hand Cash">Hand Cash</option>
                          <option value="Pix">
                            Transference Pix
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button
                    type="submit"
                    class="
                      btn btn-primary btn-sm
                      font-weight-bold
                      text-white
                      float-right
                      mt-3
                    "
                  >
                    Buy Now
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card mb-4">
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
                  Expense Insert
                </h6>
              </div>
              <div class="table-responsive" id="table">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Name</th>
                      <th>Qty</th>
                      <th>Unit</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cart in carts" :key="cart.id">
                      <td>{{ cart.pro_name }}</td>
                      <td id="qty">
                        <input
                          type="text"
                          readonly
                          :value="cart.pro_quantity"
                        />
                        <button
                          @click.prevent="increment(cart.id)"
                          class="btn btn-sm btn-primary font-weight-bold"
                          style="padding: 0 3px"
                        >
                          +
                        </button>
                        <button
                          v-if="cart.pro_quantity >= 2"
                          @click.prevent="decrement(cart.id)"
                          class="btn btn-sm btn-danger font-weight-bold"
                          style="padding: 0 3px"
                        >
                          -
                        </button>
                        <button
                          v-else-if="cart.pro_quantity <= 1"
                          class="btn btn-sm btn-danger font-weight-bold"
                          style="padding: 0 3px"
                          disabled
                        >
                          -
                        </button>
                      </td>
                      <td>{{ cart.product_price }}</td>
                      <td>{{ cart.sub_total }}</td>
                      <td>
                        <a
                          @click="removeCart(cart.id)"
                          class="
                            btn btn-sm btn-danger
                            text-white
                            font-weight-bold
                          "
                          style="padding: 0 3px"
                          >x</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr />
              <div class="card-body">
                <ul class="list-group" id="details">
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Total Quantity:</span>
                    <strong>{{ quantity }} Products</strong>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Sub Total:</span> <strong>{{ subtotal }} $</strong>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Vat:</span> <strong>{{ vats.vat }} %</strong>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <span>Total:</span>
                    <strong
                      >{{ (subtotal * vats.vat) / 100 + subtotal }} $</strong
                    >
                  </li>
                </ul>
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

  created() {
    this.allProduct(); // crud - Read
    this.allCategory(); // crud - Read
    this.allCustomer(); // crud - Read
    this.vat(); // crud - Read

    this.productCart(); // crud - Read
    Reload.$on("a", () => {
      this.productCart();
    });
  },

  data() {
    return {
      // Infos
      customer_id: "",
      pay: "",
      due: "",
      payby: "",
      order_date: "",
      // ------

      products: [],
      getproducts: [],
      carts: [],
      categories: "",
      customers: "",
      vats: "",

      searchTerm: "",
      getsearchTerm: "",
    };
  },

  computed: {
    filtersearch() {
      return this.products.filter((product) => {
        return product.product_name.match(this.searchTerm);
      });
    },

    getfiltersearch() {
      return this.getproducts.filter((getproduct) => {
        return getproduct.product_name.match(this.getsearchTerm);
      });
    },

    quantity() {
      // total quantity SOMA
      let sum = 0;
      let i = 0;

      for (i; i < this.carts.length; i++) {
        sum += parseFloat(this.carts[i].pro_quantity);
      }

      return sum;
    },

    subtotal() {
      let sum = 0;
      let i = 0;

      for (i; i < this.carts.length; i++) {
        sum +=
          parseFloat(this.carts[i].pro_quantity) *
          parseFloat(this.carts[i].product_price);
      }

      return sum;
    },
  },

  methods: {
    // Card Methods
    addCart(id) {
      let url = "/api/addCart/" + id;
      axios
        .get(url)
        .then(() => {
          Reload.$emit("a");
          Notification.cart_success();
        })
        .catch();
    },
    productCart() {
      let url = "/api/cart/product/";
      axios
        .get(url)
        .then(({ data }) => (this.carts = data))
        .catch();
    },
    removeCart(id) {
      let url = "api/remove/cart/" + id;
      axios
        .get(url)
        .then(() => {
          Reload.$emit("a");
          Notification.delete();
        })
        .catch();
    },
    increment(id) {
      let url = "api/increment/" + id;

      axios.get(url).then(() => {
        Reload.$emit("a");
        Notification.cart_success();
      });
    },
    decrement(id) {
      let url = "api/decrement/" + id;

      axios
        .get(url)
        .then(() => {
          Reload.$emit("a");
          Notification.delete();
        })
        .catch();
    },
    vat() {
      let url = "/api/vats/";
      axios
        .get(url)
        .then(({ data }) => (this.vats = data))
        .catch();
    },
    // ---------- End Cart ------------
    // Order Methods
    orderdone() {
      let url = '/api/orderdone/'
      let total = (this.subtotal * this.vats.vat) / 100 + this.subtotal;

      var data = {
        quantity: this.quantity, // quantiy (computed)
        subtotal: this.subtotal,
        customer_id: this.customer_id,
        payby: this.payby,
        pay: this.pay,
        due: this.due,
        vat: this.vats.vat,
        total: total,
      }; 

      axios.post(url, data)
        .then(() => {
          Notification.success()
          this.$router.push({ name: 'home' })
        })
        .catch()
    },
    // ---------- End Order ------------

    allProduct() {
      // crud - read
      let url = "api/product";

      axios
        .get(url)
        .then(({ data }) => (this.products = data))
        .catch();
    },
    // Categories
    allCategory() {
      // crud - read
      let url = "api/category";

      axios
        .get(url)
        .then(({ data }) => (this.categories = data))
        .catch();
    },
    // Customer
    allCustomer() {
      // crud - read
      let url = "api/customer";

      axios
        .get(url)
        .then(({ data }) => (this.customers = data))
        .catch();
    },
    // Sub Products
    subproduct(id) {
      // crud - read
      let url = "api/getting/product/" + id;

      axios
        .post(url)
        .then(({ data }) => (this.getproducts = data))
        .catch();
    },
  },
};
</script>


<style type="text/css">
#em_photo {
  height: 100px;
  width: 88%;
}
.card-header,
.card-title {
  font-weight: 700;
  font-size: 12px;
  text-align: center;
}
#table {
  font-size: 12px;
}
#nav-tab {
  font-size: 13px;
  font-weight: 700;
}
#card-prod {
  width: 9rem;
  height: 15rem;
}
label {
  font-size: 13px;
  color: #a38cff;
  font-weight: 600;
}
#qty input {
  width: 30px;
  text-align: center;
}

#details span {
  font-weight: 700;
  font-size: 14px;
  color: #a38cff;
  padding: 0;
  margin: 0;
}
#details strong {
  font-size: 13px;
  color: green;
  font-style: italic;
}
</style>