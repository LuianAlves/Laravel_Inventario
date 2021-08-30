<template>
  <div>
    <div class="row justify-content-between mb-3 mt-5">
      <div class="col-6">
        <router-link
          to="/store-expense"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-marker"></i>
          </span>
          <span class="text">New Expense</span>
        </router-link>
      </div>
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
            <h6 class="m-0 font-weight-bold text-primary">List Expenses</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center">
                  <th class="text-left">Details</th>
                  <th>Amount</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="expense in filtersearch" :key="expense.id" class="text-center">
                  <td class="text-left">{{ expense.details }}</td>
                  <td>{{ expense.amount }} $</td>
                  <td>{{ expense.expense_date }}</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-expense', params: { id: expense.id } }"
                      class="btn btn-info btn-sm"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <a
                      @click="deleteExpense(expense.id)"
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
      expenses: [],
      searchTerm: "",
    };
  },

  methods: {
    allExpense() {
      // crud - Read
      let url = "api/expense";
      axios
        .get(url)
        .then(({ data }) => (this.expenses = data))
        .catch();
    },

    deleteExpense(id) {
      // crud - Delete
      let url = "api/expense/" + id;

      Swal.fire({
        // alert-modal
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(url)
            .then(() => {
              this.expenses = this.expenses.filter((expense) => {
                return expense.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "expense" });
            });

          Notification.delete(); // notification
        }
      });
    },
  },

  computed: {
    // search itens
    filtersearch() {
      return this.expenses.filter((expense) => {
        return expense.expense_date.match(this.searchTerm);
      });
    },
  },

  mounted() {
    this.allExpense(); // crud - Read
  },
};
</script>
