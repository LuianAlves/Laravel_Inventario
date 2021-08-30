<template>
    <div></div>
</template>

<script>
export default {
    created() {
        localStorage.removeItem("token");
        localStorage.removeItem("user");

        // Alert Logged
        Toast.fire({
            icon: "warning",
            title: "Logout Successfully!"
        });

        this.$router.push({ name: "/" }); // redirecionar rota
    }
};
</script>
