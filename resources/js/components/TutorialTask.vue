<template>
    <div>
        <tutorial :initialTutorials="initialTutorials" />

        <task :initialTasks="initialTasks" />
    </div>
</template>

<script>
import Tutorial from "./Tutorial/Tutorial.vue";
import Task from "./Task/Task.vue";

export default {
    components: {
        Tutorial,
        Task
    },
    props: {
        initialTutorials: {
            type: Array,
            default: []
        },
        initialTasks: {
            type: Array,
            default: []
        },
        initialTutorialId: {
            type: Number
        }
    },
    mounted: function() {
        this.$store.dispatch(
            "tutorial/initialTutorialId",
            this.initialTutorialId
        );
    }
};
</script>
