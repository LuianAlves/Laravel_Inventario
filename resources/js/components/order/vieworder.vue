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
          <span class="text">Go Back</span>
        </router-link>
      </div>
    </div>

    <div class="row justify-content-between mb-5">
      <!-- Customers Details -->
      <div class="col-5">
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
            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
          </div>
          <div class="table-responsive">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between">
                <b> Name:</b> <span>{{ orders.name }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <b> Phone:</b> <span>{{ orders.phone }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <b> Address:</b> <span>{{ orders.address }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <b> Date:</b> <span>{{ orders.order_date }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <b> Pay Through:</b> <span>{{ orders.payby }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Price Details -->
      <div class="col-5">
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
            <h6 class="m-0 font-weight-bold text-primary">Price Details</h6>
          </div>
          <div class="table-responsive">
            <ul class="list-group">
              <li
                class="list-group-item d-flex justify-content-between text-info"
              >
                <b> Sub Total:</b> <span>$ {{ orders.sub_total }}</span>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  text-warning
                "
              >
                <b> Vat:</b> <span>{{ orders.vat }} %</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between text-info"
              >
                <b> Total:</b> <span>$ {{ orders.total }}</span>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  text-success
                "
              >
                <b> Pay Amount:</b> <span>$ {{ orders.pay }}</span>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  text-danger
                "
              >
                <b> Due Amount:</b> <span>$ {{ orders.due }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-2">
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
            <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center">
                  <th class="text-left">Product Name</th>
                  <th class="text-left">Product Code</th>
                  <th>Image</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="detail, key in details" :key="key" class="text-center">
                  <td class="text-left">
                    <a href="#">{{ detail.product_name }}</a>
                  </td>
                  <td class="text-left">{{ detail.product_code }}</td>
                  <td>
                    <img
                      :src="'/'+detail.image"
                      style="height: 40px; width: 40px; border-radius: 50%"
                    />
                  </td>
                  <td>{{ detail.pro_quantity }} Unit</td>
                  <td class="text-info"><span>{{ detail.product_price }} $</span></td>
                  <td class="text-success"><span>{{ detail.sub_total }} $</span></td>
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
      orders: {},
      details: {},
    };
  },

  created() {
    let id = this.$route.params.id;
    let urlDetails = "/api/order/details/";
    let urlODetails = "/api/order/orderdetails/";

    axios
      .get(urlDetails + id)
      .then(({ data }) => (this.orders = data))
      .catch();

    axios
      .get(urlODetails + id)
      .then(({ data }) => (this.details = data))
      .catch();
  },

  methods: {},
};
</script>

<style  scoped>
ul li b {
  color: #3e269e6c;
}
span{
  font-size: 14px;
  font-style: italic;
  font-weight: 700;
}
</style>