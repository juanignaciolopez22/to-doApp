{literal}  <!-- with "literal" you tell Smarty there won't be Smarty code inside;
that's why, in this case, I use vue.js instead -->

<div id="app">
    <div class="container-folders">
        <div class="d-flex justify-content-center">
            <img src="https://img.icons8.com/ios-filled/200/000000/moleskine.png"/>
        </div>
        <div class="d-flex justify-content-center">   
        <!-- addFolder -->
            <form id="send-folder" v-on:submit.prevent="addFolder">
                <input type="text" name="namefolder" placeholder="Create a new folder" required>
                <button type="submit" class="btn-info text-white btn-lg">Add</button>
            </form>
        </div>


        <div class="d-flex justify-content-center flex-container">
{/literal}
            {include file='templates/vue/folders-render.tpl'} 
            {include file='templates/vue/tasks-render.tpl'}
            
        </div>
    </div>
</div>

