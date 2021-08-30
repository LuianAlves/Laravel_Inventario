<template>
  <div>
    <div class="row justify-content-between mb-3 mt-5">
      <div class="col-3">
        <input
          v-model="searchTerm"
          class="form-control form-control-sm float-right"
          type="text"
          placeholder="Search Expense"
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
            <h6 class="m-0 font-weight-bold text-primary">Today Order</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th>PayBy</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in filtersearch" :key="order.id" class="font-weight-bold">
                  <td>{{ order.name }}</td>
                  <td class="text-info">{{ order.total }} $</td>
                  <td class="text-success">{{ order.pay }} $</td>
                  <td class="text-danger">{{ order.due }} $</td>
                  <td>{{ order.payby }}</td>

                  <td>
                    <router-link
                      :to="{ name: 'view-order', params: { id: order.id } }"
                      class="btn btn-info btn-sm"
                    >
                      <i class="fas fa-eye"></i>
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
      orders: [],
      searchTerm: "",
    };
  },

  computed: {
    // search itens
    filtersearch() {
      return this.orders.filter((order) => {
        return order.name.match(this.searchTerm);
      });
    },
  },

  methods: {
    allOrder() {
      // crud - Read
    //   let url = "";
      axios
        .get('/api/orders/')
        .then(({ data }) => (this.orders = data))
        .catch();
    },
  },

  mounted() {
    this.allOrder(); // crud - Read
  },
};
</script>
