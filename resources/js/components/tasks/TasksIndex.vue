<template>
    <h3 style="text-align: center" v-if="!tasks[0]">No Tasks</h3>

    <div class="card text-center mt-2 mb-2" v-for="task in tasks" v-bind:key="task.id">
        <div class="card-header " :class="[showStatusColor(task.status)]">
            <strong>{{ showStatus(task.status) }}</strong>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ task.title }}</h5>
            <p class="card-text">{{ task.description }}</p>
            <footer class="blockquote-footer fw-bold mt-1"><cite title="Date to Finish">Date to Finish: {{ task.end_date }}</cite></footer>
            <router-link class="btn btn-light m-lg-2" role="button" :to="{ name: 'subtask.create', params: {  task_id: task.id } }">Subtask Create</router-link>
            <router-link class="btn btn-light m-lg-2" role="button" :to="{ name: 'tasks.edit', params: { id: task.id } }">Task Edit</router-link>
            <button type="button" class="btn btn-danger m-lg-2" @click="deleteTask(task.id)">Delete</button>
        </div>

        <div class="row mb-2" v-if="task.subtasks">
            <div class="col-3 mx-auto mt-2" v-for="subtask in task.subtasks" v-bind:key="subtask.id">
                <div class="card" style="width: 18rem;">
                    <div class="">
                        <div class="card-header" :class="[showStatusColor(subtask.status)]">
                            <strong>{{ showStatus(subtask.status) }}</strong>
                        </div>
                        <h5 class="card-title">{{ subtask.title }}</h5>
                        <p class="card-text">{{ subtask.description }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Date to Finish: {{ subtask.end_date }}</h6>
                        <router-link class="btn btn-light m-lg-2" role="button" :to="{ name: 'subtask.edit', params: {  subtask_id: subtask.id } }">Subtask Edit</router-link>
                        <button type="button" class="btn btn-danger m-lg-2" @click="deleteSubtask(subtask.id)">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="alert alert-danger" role="alert" v-if="errored">
        Error download Data!!!
    </div>
    <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
        <span class="sr-only">Loading...</span>
    </div>
</template>

<script>
import useTasks from "../../composables/tasks";
import useSubtasks from "../../composables/subtask";
import getStatus from "../../helpers/status";
import { onMounted } from "vue";
export default {

    setup() {
        const { tasks, getTasks, destroyTask} = useTasks()
        const { destroySubtask } = useSubtasks()
        const status = getStatus();
        const statusColor = getStatus();

        onMounted(getTasks)

        const deleteTask = async (id) => {
            if(!window.confirm('Are you sure?')) {
                return
            }

            await destroyTask(id);
            await getTasks();
        }

        const deleteSubtask = async (id) => {
            if(!window.confirm('Are you sure?')) {
                return
            }

            await destroySubtask(id);
            await getTasks();
        }

        const showStatus = (id) => {
            return status.statusName[id].name;
        }

        const showStatusColor = (id) => {
            return statusColor.statusName[id].color;
        }

        return {
            tasks,
            showStatus,
            showStatusColor,
            deleteTask,
            deleteSubtask
        }
    }

}
</script>

<style scoped>

</style>
