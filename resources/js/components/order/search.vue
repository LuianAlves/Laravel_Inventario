<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/order"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">Today Orders</span>
        </router-link>
      </div>
    </div>

    <div class="row my-2">
      <div class="col-7">
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">

                  <form
                    class="user"
                    @submit.prevent="searchDate"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-6">
                          <label><b>Order Date</b></label>
                          <input
                            type="date"
                            class="form-control form-control-sm"
                            v-model="date"
                            required
                          />
                        </div>
                        <div class="col-3 offset-2" style="margin-top: 30px">
                          <button
                            type="submit"
                            class="
                              btn btn-info btn-sm btn-icon-split
                              font-weight-bold
                              float-right
                            "
                          >
                            <span class="text">Search</span>
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

    <div class="row my-4">
      <div class="col-12">
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
            <h6 class="m-0 font-weight-bold text-primary">Order Dates</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center">
                  <th class="text-left">Product Name</th>
                  <th>Quantity</th>
                  <th>Sub Total</th>
                  <th>Vat</th>
                  <th>Total</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order, key in orders" :key="key" class="text-center font-weight-bold">
                  <td class="text-left">
                    <a href="#">{{ order.name }}</a>
                  </td>
                  <td>{{ order.quantity }}</td>
                  <td class="text-info">{{ order.sub_total }} $</td>
                  <td class="text-warning">{{ order.vat }} %</td>
                  <td class="text-info">{{ order.total }} $</td>
                  <td class="text-success">{{ order.pay }} $</td>
                  <td class="text-danger">{{ order.due }} $</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
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
      date: '',
      orders: {}
    };
  },

  methods: {
    searchDate() {
      let url = "api/search/order/";
      var data = {date: this.date}

      axios
        .post(url, data)
        .then(({ data }) => (this.orders = data))
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
