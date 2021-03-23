<template>
    <div class="d-flex flex-row border p-3 mt-1 tutorial">
        <input
            type="hidden"
            name="tutorial_task_names"
            :value="listsJson"
            required
        />
        <roadmap-tutorial-list
            v-for="(list, index) in lists"
            :key="list.id"
            :title="list.title"
            :tasks="list.tasks"
            :listIndex="index"
        />
        <div class="p-2 mr-1">
            <roadmap-tutorial-add />
        </div>
    </div>
</template>

<script>
import RoadmapTutorialAdd from "./RoadmapTutorialAdd";
import RoadmapTutorialList from "./RoadmapTutorialList";
import { mapState } from "vuex";

export default {
    components: {
        RoadmapTutorialAdd,
        RoadmapTutorialList
    },
    props: {
        old: {
            type: Object
        }
    },
    data() {
        return {
            // getLists:this.initialTutorials,
            getLists: this.old.tutorial_task_names
        };
    },
    mounted: function() {
        if (this.getLists) {
            this.$store.dispatch("roadmap/initiallist", this.getLists);
        }
    },
    computed: {
        ...mapState({
            lists: state => state.roadmap.lists
        }),
        listsJson() {
            return JSON.stringify(this.lists);
        }
    }
};
</script>
