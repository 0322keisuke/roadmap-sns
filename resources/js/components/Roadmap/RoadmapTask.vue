<template>
    <div class="d-flex flex-row list border p-2 my-2">
        {{ name }}
        <div v-if="editable" class="deletelist" @click="removeTask">×</div>
    </div>
</template>

<script>
import { mapState } from "vuex";

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
    computed: {
        ...mapState({
            editable: state => state.roadmap.editable
        })
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
