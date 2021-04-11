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
        if (state.lists.length == 1)
            state.display_tutorial_id = state.lists[0].id;
    },
    removeTutorial(state, payload) {
        state.lists = payload.response.tutorials;
        console.log(payload.response.tutorials);
        if (payload.response.tutorials[0] === undefined) {
            state.display_tutorial_id = 0;
            state.display_tutorial_listIndex = 0;
            return;
        }
        if (state.display_tutorial_id == payload.payload.id) {
            if (state.display_tutorial_listIndex == 0) {
                state.display_tutorial_id = state.lists[0].id;
            } else {
                state.display_tutorial_id =
                    state.lists[payload.payload.listIndex - 1].id;

                state.display_tutorial_listIndex -= 1;
            }
        } else {
            if (state.display_tutorial_listIndex > payload.payload.listIndex)
                state.display_tutorial_listIndex -= 1;
        }
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

        context.commit("removeTutorial", {
            response: response.data,
            payload: payload
        });
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
