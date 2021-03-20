<template>
    <div class="border p-3 mt-1 tutorial">
        <div class="d-flex flex-row">
            <tutorial-list
                v-for="(list, index) in lists"
                :key="list.id"
                :id="list.id"
                :title="list.title"
                :listIndex="index"
            />
            <div class="p-2 mr-1">
                <tutorial-add />
            </div>
        </div>
    </div>
</template>

<script>
import TutorialAdd from "./TutorialAdd";
import TutorialList from "./TutorialList";
import { mapState } from "vuex";

export default {
    components: {
        TutorialAdd,
        TutorialList
    },
    props: {
        initialTutorials: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            getLists: this.initialTutorials
        };
    },
    mounted: function() {
        this.$store.dispatch("tutorial/initiallist", this.getLists);
    },
    computed: {
        ...mapState({
            lists: state => state.tutorial.lists
        })
    }
};
</script>
