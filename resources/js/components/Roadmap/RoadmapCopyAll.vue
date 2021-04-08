<template>
    <div class="d-flex">
        <button
            class="btn btn-lg teal accent-4 text-white ml-auto"
            :disabled="isCopyedBy"
            @click="CopyAllTutorialTask"
        >
            「学習中の教材」へ追加
        </button>
    </div>
</template>
<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            isCopyedBy: false
        };
    },
    computed: {
        ...mapState({
            lists: state => state.roadmap.lists
        })
    },
    methods: {
        CopyAllTutorialTask() {
            if (confirm("学習中の教材へコピーしますか？")) {
                axios.post("/roadmaps/copy", this.lists);

                this.isCopyedBy = true;
            }
        }
    }
};
</script>
