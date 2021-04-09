const state = {
    lists: [],
    display_tutorial_id: 0,
    display_tutorial_listIndex: 0
};

const mutations = {
    initiallist(state, payload) {
        state.lists = payload;
    },
    initialTutorialId(state, payload) {
        state.display_tutorial_id = payload;
    },
    addlist(state, payload) {
        state.lists = payload.tutorials;
    },
    removeTutorial(state, payload) {
        state.lists = payload.tutorials;
    },
    changeDisplayTutorialId(state, payload) {
        state.display_tutorial_id = payload.id;
        state.display_tutorial_listIndex = payload.listIndex;
    },
    updateTutorialStatus(state, payload) {
        state.lists[payload.listIndex].status = payload.status;
    }
};

const actions = {
    initialTutorialId(context, payload) {
        context.commit("initialTutorialId", payload);
    },
    initiallist(context, payload) {
        context.commit("initiallist", payload);
    },
    async addlist(context, payload) {
        const response = await axios.post("/tutorials/store", payload);
        context.commit("addlist", response.data);

        context.commit("task/addTaskForNewTutorial", response.data, {
            root: true
        });
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
    },
    async updateTutorialStatus(context, payload) {
        await axios.patch(`/tutorials/${payload.id}/status`, payload);

        context.commit("updateTutorialStatus", payload);
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
