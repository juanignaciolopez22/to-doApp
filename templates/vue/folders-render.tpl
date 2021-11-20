{literal} 
<div class="flexpart1">
<!-- list folders on left side-->
    <div v-for="folder in folders" class="container-folder">
        <div class="d-flex align-items-center">
            <img class="img-folder" src="https://img.icons8.com/color/30/000000/folder-invoices--v2.png"/>
            <h3>{{folder.name}}</h3>
        </div>
        <a class="btn btn-info text-white" v-on:click="showTasks(folder)">View items</a><a class="btn btn-secondary" v-on:click="deleteFolder(folder.id)">Remove</a>
    </div>
</div>
{/literal} 