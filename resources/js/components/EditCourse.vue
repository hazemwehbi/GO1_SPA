<template>
    <div>
        <h4 class="text-center">Edit Course</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCourse">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="course.name">
                    </div><br>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="course.description">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            course: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/courses/edit/${this.$route.params.id}`)
                .then(response => {
                    this.course = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateCourse() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/courses/update/${this.$route.params.id}`, this.course)
                    .then(response => {
                        this.$router.push({name: 'courses'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
