<template>

    <li class="nav-item">
        <router-link :to="{name: 'tasks.index'}" class="nav-link" style="color: rgba(0, 0, 0, 0.9); font-size: 1.125rem;">Tasks</router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{name: 'tasks.create'}" class="nav-link" style="color: rgba(0, 0, 0, 0.9); font-size: 1.125rem;">Create Task</router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{name: 'user.token'}" class="nav-link" style="color: rgba(0, 0, 0, 0.9); font-size: 1.125rem;">User Token</router-link>
    </li>

<!--    <li class="nav-item">
        <router-link :to="{name: 'Add Task'}" class="nav-link" style="color: rgba(0, 0, 0, 0.9); font-size: 1.125rem;">Add Task</router-link>
    </li>-->

</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>

</style>
