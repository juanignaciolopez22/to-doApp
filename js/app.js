"use strict"

const TASKS_URL = "api/tasks";
const FOLDERS_URL = "api/folders";


let app = new Vue({
    el: "#app",
    data: {
        folders: [],
        tasks:[],
        currentFolder:false,
        taskToEdit:false
    },
    methods: {
        deleteFolder: function(folderId) {deleteFolder(folderId)},
        addFolder: function(){addFolder()},
        addTask: function(folder){addTask(folder)},
        showTasks: function(folder){showTasks(folder)},
        deleteTask:function(taskId){deleteTask(taskId)},
        undoneTask:function(taskId){undoneTask(taskId)},
        doneTask:function(taskId){doneTask(taskId)},
        updateDescription:function(taskId){updateDescription(taskId)},
        confirmUpdateDescription:function(taskId){confirmUpdateDescription(taskId)}
    }
});

function changeDescriptionTask(description){
    return {
        "description":description,
    }
}
function confirmUpdateDescription(taskId){
    let valueToSave= document.querySelector("#input-edit-task").value;
    let task= changeDescriptionTask(valueToSave);
    let url=TASKS_URL + "/" + taskId;
    updateTask(url,task);
}

function updateDescription(taskId){
    app.taskToEdit=taskId;
}

function changeStateTask(state){
    return {
        "done":state,
    }
}
function doneTask(taskId){
    let task= changeStateTask(1);
    let url=TASKS_URL + "/" + taskId;
    updateTask(url,task);
}

function undoneTask(taskId){
    let task= changeStateTask(0);
    let url=TASKS_URL + "/" + taskId;
    updateTask(url,task);
}
async function updateTask(url,task){
    try {
        let res = await fetch(url, {
            "method": "PUT",
            "headers": { "Content-type": "application/json" },
            "body": JSON.stringify(task),
        });
        if (res.status == 200) {
            console.log("task updated!"); 
            showTasks(app.currentFolder);
        }
    } catch (error) {
        console.log(error);
    }
}
async function deleteTask(id){
    try {
        let res = await fetch(TASKS_URL + "/" + id, {
            "method": "DELETE",
        });
        if (res.status == 200) {
            console.log("task deleted!");
            showTasks(app.currentFolder);
        }
    } catch (e) {
        console.log(e);
    }
}

async function addTask(folder){
    let formTask= document.querySelector("#send-task");
    let formData = new FormData(formTask);
    let description= formData.get("description");
    let newTask={
        "description":description,
        "id_folder":folder.id,
        "done":0
    }
    try {
        let res = await fetch(TASKS_URL, {
            "method": "POST",
            "headers": { "Content-type": "application/json" },
            "body": JSON.stringify(newTask),
        });
        if (res.status == 200) {
            console.log("task created!");
            showTasks(folder);
            formTask.reset();
        }
    } catch (error) {
        console.log(error);
    }
}

async function showTasks(folder){
    let url= TASKS_URL + "?id_folder=" + folder.id;
    try {
        let response = await fetch(url);
        let tasks = await response.json();
        app.tasks = tasks;
        app.currentFolder=folder;
        app.taskToEdit=false;
    } catch (e) {
        console.log(e);
    }
}

async function addFolder() {
    let formFolder= document.querySelector("#send-folder");
    let formData = new FormData(formFolder);
    let name = formData.get("namefolder");
    let newFolder={
        "name":name,
    }
    try {
        let res = await fetch(FOLDERS_URL, {
            "method": "POST",
            "headers": { "Content-type": "application/json" },
            "body": JSON.stringify(newFolder),
        });
        if (res.status == 200) {
            console.log("folder created!");
            getFolders(FOLDERS_URL);
            app.currentFolder=false;
            app.tasks=[];
            app.taskToEdit=false;
            formFolder.reset();
        }
    } catch (error) {
        console.log(error);
    }
}

async function deleteFolder(id) {
    try {
        let res = await fetch(FOLDERS_URL + "/" + id, {
            "method": "DELETE",
        });
        if (res.status == 200) {
            console.log("folder deleted!");
            getFolders(FOLDERS_URL);
            app.currentFolder=false;
            app.tasks=[];

        }
    } catch (e) {
        console.log(e);
    }
}

async function getFolders(url) {
    try {
        let response = await fetch(url);
        let folders = await response.json();
        app.folders = folders;
    } catch (e) {
        console.log(e);
    }
}

getFolders(FOLDERS_URL); //by default




