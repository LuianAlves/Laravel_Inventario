<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Today Sell -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="row">
                  <div class="col-auto mt-2 mr-1">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                  </div>
                  <div class="col">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                      Total Amount
                    </div>
                    <div class="h5 mt-2 mb-2 font-weight-bold text-info">
                      $ {{ allsell }}
                    </div>
                  </div>
                  <div class="col">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                      Today Sell Amount
                    </div>
                    <div class="h5 mt-2 mb-2 font-weight-bold text-success">
                      $ {{ todaysell }}
                    </div>
                  </div>
                </div>
                <div class="mt-3 mb-0 text-muted text-xs text-center">
                  <span class="text-info mr-2"
                    ><i class="fa fa-arrow-up"></i> 3.48%</span
                  >
                  <span>Since last month</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Today Income (pay) -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="row">
                  <div class="col-auto mt-2">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                  </div>
                  <div class="col-6">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                      Today Income Amount
                    </div>
                    <div class="h5 mt-2 mb-2 font-weight-bold text-success">
                      $ {{ income }}
                    </div>
                  </div>
                  <div class="col">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                      Today Due
                    </div>
                    <div class="h5 mt-2 mb-2 font-weight-bold text-danger">
                      $ {{ incomedue }}
                    </div>
                  </div>
                </div>
                <div class="mt-3 mb-0 text-muted text-xs text-center">
                  <span class="text-info mr-2"
                    ><i class="fas fa-arrow-up"></i> 12%</span
                  >
                  <span>Since last years</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Due -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                  Total Due Amount
                </div>
                <div class="h5 mt-2 mb-2 mr-3 font-weight-bold text-danger">
                  $ {{ due }}
                </div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-info mr-2"
                    ><i class="fas fa-arrow-up"></i> 20.4%</span
                  >
                  <span>Since last month</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Today Expense -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                  Total Expense
                </div>
                <div class="h5 mb-0 font-weight-bold text-danger">
                  $ {{ expense }}
                </div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-warning mr-2"
                    ><i class="fas fa-arrow-down"></i> 1.10%</span
                  >
                  <span>Since yesterday</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Due List -->
      <div class="col-12 mb-3">
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
            <h6 class="mt-2 font-weight-bold text-primary text-left">
              Due List
            </h6>

            <div class="col-6 offset-1">
              <input
                v-model="searchTerm"
                class="form-control form-control-sm float-right"
                type="text"
                placeholder="Search Name"
              />
            </div>
            <div class="col-3">
              <router-link
                class="m-0 float-right font-weight-bold btn btn-danger btn-sm"
                to="/order"
                >View More <i class="fas fa-chevron-right"></i
              ></router-link>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <!-- <th>Pay</th> -->
                  <th>Due</th>
                  <th class="text-center">Pay By</th>
                  <th>Order Date</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(due, key) in filtersearch"
                  :key="key"
                  class="font-weight-bold"
                >
                  <td>
                    <a href="#">{{ due.name }}</a>
                  </td>
                  <td>{{ due.phone }}</td>
                  <!-- <td>
                    <span class="badge badge-success">{{ due.pay }} $</span>
                  </td> -->
                  <td>
                    <span class="badge badge-danger">{{ due.due }} $</span>
                  </td>
                  <td class="text-center">{{ due.payby }}</td>
                  <td>{{ due.order_date }}</td>
                  <td class="text-center">
                    <!-- <router-link
                      :to="{ name: 'pay-salary', params: { id: employee.id } }"
                      class="btn btn-info btn-sm"
                    > -->
                    <i class="fas fa-money-check-alt"></i>
                    <!-- </router-link> -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Last Orders -->
      <div class="col-6">
        <div class="card">
          <div
            class="
              card-header
              py-4
              bg-primary
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-light">Last Orders</h6>
          </div>
          <div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">
                  Hi there! I am wondering if you can help me with a problem
                  I've been having.
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">
                  Udin Cilok · 58m
                </div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a href="#">
                <div class="text-truncate message-title">
                  But I must explain to you how all this mistaken idea
                </div>
                <div class="small text-gray-500 message-time">
                  Nana Haminah · 58m
                </div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">
                  Jajang Cincau · 25m
                </div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">
                  At vero eos et accusamus et iusto odio dignissimos ducimus qui
                  blanditiis
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">
                  Udin Wayang · 54m
                </div>
              </a>
            </div>
            <div class="card-footer text-center">
              <a class="m-0 small text-primary card-link" href="#"
                >View More <i class="fas fa-chevron-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- All Expenses -->
      <div class="col-6">
        <div class="card">
          <div
            class="
              card-header
              py-4
              bg-primary
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-light">All Expenses</h6>
          </div>
          <div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">
                  Hi there! I am wondering if you can help me with a problem
                  I've been having.
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">
                  Udin Cilok · 58m
                </div>
              </a>
            </div>

            <div class="card-footer text-center">
              <a class="m-0 small text-primary card-link" href="#"
                >View More <i class="fas fa-chevron-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- Stock Out -->
      <div class="col-lg-12 mt-3">
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
            <h6 class="mt-2 text-left font-weight-bold text-primary">
              Stock Out
            </h6>
            <div class="col-6 offset-1">
              <input
                v-model="searchProducts"
                class="form-control form-control-sm float-right"
                type="text"
                placeholder="Search Name"
              />
            </div>
            <div class="col-3">
              <router-link
                class="m-0 float-right font-weight-bold btn btn-warning btn-sm"
                to="/stock"
                >Stock<i class="ml-2 fas fa-chevron-right"></i
              ></router-link>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light text-center">
                <tr>
                  <th class="text-left">Name</th>
                  <th>Image</th>
                  <th>Code</th>
                  <th>Buying Price</th>
                  <th>Selling Price</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="text-center font-weight-bold">
                <tr v-for="product in filterProducts" :key="product.id">
                  <td class="text-left">{{ product.product_name }}</td>
                  <td>
                    <img
                      :src="product.image"
                      style="height: 40px; width: 40px; border-radius: 50%"
                    />
                  </td>
                  <td>{{ product.product_code }}</td>
                  <td class="text-info">$ {{ product.buying_price }}</td>
                  <td class="text-success">$ {{ product.selling_price }}</td>
                  <td v-if="product.product_quantity >= 1">
                    <span class="badge badge-success">Avaliable</span>
                  </td>
                  <td v-else-if="product.product_quantity < 1">
                    <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
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
      allsell: "",
      todaysell: "",
      income: "",
      incomedue: '',
      due: "",
      expense: "",
      due_list: [],
      products: [],
      searchTerm: "",
      searchProducts: "",
      // ----
      orders: [],
    };
  },

  computed: {
    // search itens
    filtersearch() {
      return this.due_list.filter((due) => {
        return due.name.match(this.searchTerm);
      });
    },
    // search stock
    filterProducts() {
      return this.products.filter((product) => {
        return product.product_name.match(this.searchProducts);
      });
    },
    // orders list
    filterOrders() {
      return this.orders.filter((order) => {
        return order.name.match(this.searchTerm);
      });
    },
  },

  mounted() {
    this.allSell();
    this.todaySell();
    this.todayIncome();
    this.todayDue();
    this.todayExpense();
    this.duelist();
    this.StockOut();
    this.incomeDue();
  },

  methods: {
    // total sell
    allSell() {
      let url = "api/all/sell";

      axios
        .get(url)
        .then(({ data }) => (this.allsell = data))
        .catch();
    },
    // today sell
    todaySell() {
      let url = "api/today/sell";

      axios
        .get(url)
        .then(({ data }) => (this.todaysell = data))
        .catch();
    },
    // pay
    incomeDue() {
      let url = 'api/income/due'

      axios.get(url)
      .then(({ data }) => (this.incomedue = data))
      .catch();
    },
    todayIncome() {
      let url = "api/today/income";
      axios
        .get(url)
        .then(({ data }) => (this.income = data))
        .catch();
    },
    // due
    todayDue() {
      let url = "api/today/due";
      axios
        .get(url)
        .then(({ data }) => (this.due = data))
        .catch();
    },
    // expense
    todayExpense() {
      let url = "api/today/expense";

      axios
        .get(url)
        .then(({ data }) => (this.expense = data))
        .catch();
    },
    // --------------------------
    // Due list
    duelist() {
      let url = "api/due/list";
      axios
        .get(url)
        .then(({ data }) => (this.due_list = data))
        .catch();
    },
    // Stock
    StockOut() {
      let url = "api/stockout";
      axios
        .get(url)
        .then(({ data }) => (this.products = data))
        .catch();
    },
    allOrder() {
      axios
        .get("/api/orders/")
        .then(({ data }) => (this.orders = data))
        .catch();
    },
  },
};
</script>