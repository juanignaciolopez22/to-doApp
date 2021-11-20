{literal} 
<div class="flexpart2">
<!-- list folder's tasks on right side-->
    <div v-if="currentFolder" class="text-center">
        <div class="d-flex justify-content-center m-3 align-items-center">
            <img class="img-folder" src="https://img.icons8.com/color/50/000000/folder-invoices--v2.png"/>
            <h3 class="display-3">{{currentFolder.name}}</h3>
        </div>
        <form id="send-task" v-on:submit.prevent="addTask(currentFolder)">
        <!-- addTask to a folder -->
            <input type="text" name="description" placeholder="New task"required>
            <button type="submit" class="btn btn-info text-white">Add</button>
        </form>
    </div>
    <div id="list-tasks">
        <div v-for="task in tasks" class="container-task" v-bind:class="{'container-task-done': task.done == 1}">
            <div class="d-flex align-items-center">
                <h3 v-if="taskToEdit != task.id">{{task.description}}</h3>
                <div v-if="taskToEdit == task.id">
                    <input type="text" :value="task.description" id="input-edit-task">
                </div>
                <img v-if="task.done == 1"class="img-done" src="https://img.icons8.com/flat-round/40/000000/checkmark.png">
            </div>
            <div class="mt-2">
                <a class="btn btn-secondary text-white" v-on:click="updateDescription(task.id)" v-if="taskToEdit != task.id">Edit</a>
                <a class="btn btn-primary text-white" v-on:click="confirmUpdateDescription(task.id)" v-if="taskToEdit == task.id">Save</a>
                <a class="btn btn-info text-white" v-if="task.done == 1" v-on:click="undoneTask(task.id)">Undone</a>
                <a class="btn btn-info text-white" v-if="task.done == 0" v-on:click="doneTask(task.id)">Done</a>
                <a v-on:click="deleteTask(task.id)"><img src="https://img.icons8.com/color/40/000000/full-trash.png"/></a>
            </div>
        </div>
    </div>
</div>
{/literal} 