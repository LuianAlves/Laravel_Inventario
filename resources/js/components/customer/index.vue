<template>
    <div>
        <div class="row justify-content-between mb-3 mt-5">
            <div class="col-6">
                <router-link
                    to="/store-customer"
                    class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-marker"></i>
                    </span>
                    <span class="text">New Customer</span>
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
                            List Customers
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th class="text-left">Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="text-center"
                                    v-for="customer in filtersearch"
                                    :key="customer.id"
                                >
                                    <td class="text-left text-capitalize">{{ customer.name }}</td>
                                    <td>
                                        <img
                                            :src="customer.photo"
                                            style="height: 40px; width: 40px; border-radius: 50%"
                                        />
                                    </td>
                                    <td>{{ customer.phone }}</td>
                                    <td><em>{{ customer.address }}</em></td>

                                    <td>
                                        <router-link
                                            :to="{name: 'edit-customer', params: {id:customer.id} }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </router-link>
                                        <a
                                            @click="deleteCustomer(customer.id)"
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
            customers: [],
            searchTerm: ""
        };
    },

    methods: {
        allCustomer() {
            // crud - Read
            let url = "api/customer";
            axios
                .get(url)
                .then(({ data }) => (this.customers = data))
                .catch();
        },

        deleteCustomer(id) {
            // crud - Delete
            let url = "api/customer/" + id;

            Swal.fire({
                // alert-modal
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(url)
                        .then(() => {
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "customer" });
                        });

                    Notification.delete(); // notification
                }
            });
        }
    },

    computed: {
        // search itens
        filtersearch() {
            return this.customers.filter(customer => {
                return customer.name.match(this.searchTerm);
            });
        }
    },

    mounted() {
        this.allCustomer(); // crud - Read
    }
};
</script>
