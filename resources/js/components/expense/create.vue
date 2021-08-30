<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/expense"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">All Expense</span>
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
                    <h1 class="h4 text-gray-900 pb-4">Add Expense</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="expenseInsert"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name, Code, Root -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Detail -->
                        <div class="col-7">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="details"
                            ><b>Expense Details</b></label
                          >
                          <textarea
                            type="text"
                            class="form-control form-control-sm"
                            id="details"
                            placeholder="Enter Your Expense Detail"
                            rows="3"
                            v-model="form.details"
                          >
                          </textarea>
                        </div>
                        <!-- Amount -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="amount"
                            ><b>Expense Amount</b></label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="amount"
                            placeholder="Enter Your Amount"
                            v-model="form.amount"
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
        details: null,
        amount: null,
      },

      errors: {},
    };
  },

  methods: {
    expenseInsert() {
      // crud - Create
      let url = "api/expense/";

      axios
        .post(url, this.form)
        .then((response) => {
          console.log(response);

          this.$router.push({ name: "expense" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  }
};
</script>
