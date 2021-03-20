<template>
    <div class="d-flex flex-row list border p-2 m-2">
        {{ name }}
        <div class="deletelist" @click="removeTask()">×</div>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true
        },
        listIndex: {
            type: Number,
            required: true
        },
        taskIndex: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            getTasks: this.initialTasks
        };
    },
    methods: {
        removeTask: function() {
            if (confirm("本当にこのタスクを削除しますか？")) {
                this.$store.dispatch("roadmap/removeTask", {
                    listIndex: this.listIndex,
                    taskIndex: this.taskIndex
                });
            }
        }
    }
};
</script>
