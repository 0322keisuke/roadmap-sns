const state = {
    lists: [],
    display_tutorial_id: 0
};

const mutations = {
    initialTutorialId(state, payload) {
        state.display_tutorial_id = payload;
    },
    initiallist(state, payload) {
        state.lists = payload;
    },
    addlist(state, payload) {
        state.lists = payload.tutorials;
    },
    removeTutorial(state, payload) {
        state.lists = payload.tutorials;
    },
    changeDisplayTutorialId(state, payload) {
        state.display_tutorial_id = payload.id;
    }
};

const actions = {
    initialTutorialId(context, payload) {
        context.commit("initialTutorialId", payload);
    },
    async initiallist(context, payload) {
        await context.commit("initiallist", payload);
    },
    async addlist(context, payload) {
        const response = await axios.post("/tutorials/store", payload);
        context.commit("addlist", response.data);
    },
    async removeTutorial(context, payload) {
        const response = await axios.delete(
            `/tutorials/${payload.id}/destroy`,
            payload
        );

        context.commit("removeTutorial", response.data);
    },
    changeDisplayTutorialId(context, payload) {
        context.commit("changeDisplayTutorialId", payload);
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
