<template>
    <div>
        <div class="row justify-content-between mb-3 mt-5">
            <div class="col-6">
                <router-link
                    to="/store-employee"
                    class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-marker"></i>
                    </span>
                    <span class="text">New Employee</span>
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
                            List Employees
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Sallery</th>
                                    <th>Joining Date</th>
                                    <th>Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="employee in filtersearch"
                                    :key="employee.id"
                                >
                                    <td>{{ employee.name }}</td>
                                    <td>
                                        <img
                                            :src="employee.photo"
                                            style="height: 40px; width: 40px; border-radius: 50%"
                                        />
                                    </td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.sallery }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{name: 'pay-salary', params: {id:employee.id} }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fas fa-money-check-alt"></i>
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
            employees: [],
            searchTerm: ""
        };
    },

    methods: {
        allEmployee() {
            // crud - Read
            let url = "api/employee";
            axios
                .get(url)
                .then(({ data }) => (this.employees = data))
                .catch();
        }
    },

    computed: {
        // search itens
        filtersearch() {
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm);
            });
        }
    },

    mounted() {
        this.allEmployee(); // crud - Read
    }
};
</script>
