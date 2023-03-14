<template>
    <div class="card text-center mt-2 mb-2">
        Your API Token: <p class="fw-bold">{{ user.token_for_api }}</p>
       <div>
           Example API For Task:
           <p>Get all Tasks method GET: /api/tasks/{token} Example: /api/tasks/{{ user.token_for_api }}</p>
           <p>Get one Task method GET: /api/tasks/{token}/{task_id} Example: /api/tasks/{{ user.token_for_api }}/1</p>
           <p>Value:  (title, description, end_date, status) There is validation</p>
           <p>Create Task method POST: /api/tasks/{token} Example: /api/tasks/{{ user.token_for_api }}</p>
           <p>Update Task method PUT: /api/tasks/{token}/{task_id} Example: /api/tasks/{{ user.token_for_api }}/1</p>
           <p>Delete Task method DELETE: /api/tasks/{token}/{task_id} Example: /api/tasks/{{ user.token_for_api }}/1</p>
       </div>
        <hr>
        <div>
            Example API For Subtask:
            <p>Get one Subtask method GET: /api/subtask/{token}/{subtask_id} Example: /api/subtask/{{ user.token_for_api }}/2</p>
            <p>Value:  (title, description, end_date, status) There is validation</p>
            <p>Create Subtask method POST: /api/subtask/{token}/{TASK_ID} Example: /api/subtask/{{ user.token_for_api }}/1</p>
            <p>Update Subtask method PUT: /api/subtask/{token}/{subtask_id} Example: /api/subtask/{{ user.token_for_api }}/2</p>
            <p>Delete Subtask method DELETE: /api/subtask/{token}/{subtask_id} Example: /api/subtask/{{ user.token_for_api }}/2</p>
        </div>
        <div>

        </div>
    </div>
</template>

<script>
import useUser from "../../composables/user";
import { onMounted } from "vue";

export default {

    setup() {
        const { user, getUser } = useUser()

        onMounted(getUser)

        return {
            user,
        }
    }

}

</script>

