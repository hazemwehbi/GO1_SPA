<template>
    <div>
        <h4 class="text-center">Return a list of Course that have only been completed by 1 Learner</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="learnerCourse in $learnerCourses" :key="learnerCourse.id">
                <td>{{ learnerCourse.id }}</td>
                <td>{{ learnerCourse.name }}</td>
                <td>{{ learnerCourse.description }}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            $learnerCourses: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/get-learner-courses')
                .then(response => {
                    this.$learnerCourses = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
