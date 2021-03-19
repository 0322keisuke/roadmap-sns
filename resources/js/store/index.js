import Vue from "vue";
import Vuex from "vuex";

import roadmap from "./roadmap";
import tutorial from "./tutorial";
import task from "./task";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        roadmap,
        tutorial,
        task
    }
});

export default store;
