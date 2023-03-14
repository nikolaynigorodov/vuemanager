<h3 style="text-align: center">Create Tasks</h3>


<form method="POST" action="{{ route('order_process') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" v-model="form.title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description" v-model="form.description"></textarea>
    </div>
    <div class="form-group">
        <label for="end_date">Date Finish</label>
        <input type="datetime-local" class="form-control" name="end_date" v-model="form.end_date">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" v-model="form.status">
            <option value="1">Waiting</option>
            <option value="2">In progress</option>
            <option value="3">Completed</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-3">Create</button>
</form>
