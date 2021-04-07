<template>
    <div class="tutorial-list mr-1 align-top ">
        <button
            class="btn"
            :class="[displayTutorial ? 'btn-primary' : 'btn-outline-dark']"
            @click="changeDisplayTutorialId"
        >
            <p class="m-1 pr-5 text-nowrap">{{ title }}</p>
            <div
                v-if="this.id != display_tutorial_id"
                class="deletelist"
                @click="removeTutorial"
            >
                ×
            </div>
        </button>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    props: {
        id: {
            type: Number,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        listIndex: {
            type: Number,
            required: true
        }
    },
    methods: {
        removeTutorial: function() {
            if (confirm("本当にこの教材を削除しますか？")) {
                this.$store.dispatch("tutorial/removeTutorial", {
                    id: this.id,
                    listIndex: this.listIndex
                });
            }
        },
        changeDisplayTutorialId: function() {
            this.$store.dispatch("tutorial/changeDisplayTutorialId", {
                id: this.id,
                listIndex: this.listIndex
            });
        }
    },
    computed: {
        ...mapState({
            display_tutorial_id: state => state.tutorial.display_tutorial_id
        }),
        displayTutorial() {
            return this.id === this.display_tutorial_id;
        }
    }
};
</script>
