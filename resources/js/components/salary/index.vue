<template>
    <div>
        <div class="row justify-content-between mb-3 mt-5">
            <div class="col-6">
                <router-link
                    to="/given-salary"
                    class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-marker"></i>
                    </span>
                    <span class="text">Pay Salary</span>
                </router-link>
            </div>
            <div class="col-3">
                <input
                    v-model="searchTerm"
                    class="form-control form-control-sm float-right"
                    type="text"
                    placeholder="Search Name"
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
                            All Salary Details
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Month Name</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="salary in filtersearch"
                                    :key="salary.id"
                                >
                                    <td>{{ salary.salary_month }}</td>
                                    <td class="col-2">
                                        <router-link
                                            :to="{name: 'view-salary', params: {id:salary.salary_month} }"
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
            salaries: [],
            searchTerm: ""
        };
    },

    methods: {
        allSalary() {
            // crud - Read
            let url = "api/salary";
            axios
                .get(url)
                .then(({ data }) => (this.salaries = data))
                .catch();
        }
    },

    computed: {
        // search itens
        filtersearch() {
            return this.salaries.filter(salary => {
                return salary.salary_month.match(this.searchTerm);
            });
        }
    },

    mounted() {
        this.allSalary(); // crud - Read
    }
};
</script>
