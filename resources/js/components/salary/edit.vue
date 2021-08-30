<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/salary"
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

    <div class="row justify-content-center my-2">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 pb-4">Update Salary</h1>
                  </div>
                  <form class="user" @submit.prevent="salaryUpdate">
                    <!-- 01 | Name, Email -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-4 offset-1">
                            <label
                            style="font-size: 13px; color: #a38cff"
                            ><b>Name</b></label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="name"
                            placeholder="Enter Full Name"
                            v-model="form.name"
                          />
                        </div>
                        <!-- Email -->
                        <div class="col-4 offset-3">
                            <label
                            style="font-size: 13px; color: #a38cff"
                            ><b>E-mail</b></label
                          >
                          <input
                            type="email"
                            class="form-control form-control-sm"
                            id="email"
                            aria-describedby="emailHelp"
                            placeholder="Enter Email Address"
                            v-model="form.email"
                          />
                        </div>
                        
                      </div>
                    </div>

                    <!-- 02 | Months, Sallery -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Months -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            ><b>Months</b></label
                          >
                          <select
                            class="form-control form-control-sm"
                            v-model="form.salary_month"
                          >
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="Jun">Jun</option>
                            <option value="Jully">Jully</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                        </div>
                        <!-- Hidden -->
                        <input type="hidden" v-model="form.employee_id">
                        <!-- Sallery -->
                        <div class="col-4 offset-3">
                            <label
                            style="font-size: 13px; color: #a38cff"
                            ><b>Amount</b></label
                          >
                          <input
                            type="number"
                            class="form-control form-control-sm"
                            id="amount"
                            placeholder="Enter Your Salary"
                            v-model="form.amount"
                          />
                          <small class="text text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
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
                            <span class="text">Update</span>
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
        name: "",
        email: "",
        salary_month: "",
        sallery: "",
        employee_id: ''
      },

      errors: {},
    };
  },

  created() {
    let id = this.$route.params.id;

    axios
      .get("/api/edit/salary/" + id)
      .then(({ data }) => (this.form = data))
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    salaryUpdate() {
      let id = this.$route.params.id;
      let url = '/api/salary/update/' + id

      // crud - Update
      axios
        .post(url, this.form)
        .then((response) => {
          this.$router.push({ name: "salary" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    }
  },
};
</script>
