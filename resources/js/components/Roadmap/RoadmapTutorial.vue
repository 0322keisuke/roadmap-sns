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
        <div v-if="getEditable" class="p-2 mr-1">
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
        },
        initialLists: {
            type: Array
        },
        editable: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            getEditable: this.editable
        };
    },
    computed: {
        getLists() {
            //直前の入力値がない場合は、DBの値を初期表示する。
            if (0 === Object.keys(this.old).length) {
                return this.initialLists;
            }
            return JSON.parse(this.old.tutorial_task_names);
        },
        ...mapState({
            lists: state => state.roadmap.lists
        }),
        listsJson() {
            return JSON.stringify(this.lists);
        }
    },
    created: function() {
        this.$store.dispatch("roadmap/setEditable", this.getEditable);

        //"直前の入力値(old)"もしくは"DBの値(initialLists)"がある場合のみ、初期をセットする。
        if (this.getLists) {
            this.$store.dispatch("roadmap/initiallist", this.getLists);
        }
    }
};
</script>
