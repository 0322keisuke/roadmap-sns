import "./bootstrap";
import Vue from "vue";
import store from "./store";
import RoadmapTutorial from "./components/Roadmap/RoadmapTutorial";
import RoadmapCopyAll from "./components/Roadmap/RoadmapCopyAll";
import RoadmapLike from "./components/RoadmapLike";
import TutorialTask from "./components/TutorialTask";
import FollowButton from "./components/FollowButton";
import RoadmapTagsInput from "./components/RoadmapTagsInput";

const app = new Vue({
    el: "#app",
    store,
    components: {
        RoadmapTutorial,
        RoadmapCopyAll,
        RoadmapLike,
        TutorialTask,
        FollowButton,
        RoadmapTagsInput
    }
});
