<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello, this is Vue.js! <button class="btn btn-xs btn-default pull-right" onclick="swal('Test')">Test SweetAlert</button></div>

                    <div class="panel-body">
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['message']

    }

</script>