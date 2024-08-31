

const routes = [
	{
		path: '/',
		component: () => import( "@/pages/About.vue")
	},
	{
		path: '/todo',
		component: () => import( "@/pages/ToDo.vue")
	},
	{
		path: '/register',
		component: () => import( "@/pages/Register.vue")

	},
	{
		path: '/login',
		component: () => import( "@/pages/Login.vue")
	},

];

export default routes;