import { createStore } from 'vuex';
import auth from "./auth.js";


const store = createStore({
	state: {
	errors: []
	},

	getters: {
		errors: state => state.errors
	},

	mutations: {
		setErrors(state, errors) {
			state.errors = errors;
		}
	},

	actions: {},

	modules: {
		auth
	}
});

export default store;


