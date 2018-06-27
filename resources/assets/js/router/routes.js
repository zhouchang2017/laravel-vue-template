export default ({authGuard, guestGuard}) => [
  {path: '/', name: 'welcome', component: ()=>import('~/pages/welcome.vue')},
  // Authenticated routes.
  ...authGuard([
    // {
    //   path: '/home',
    //   name: 'home',
    //   component: ()=>import('~/pages/home.vue')
    // },
    {
      path: '/mws',
      name: 'mws',
      component: ()=>import('~/pages/index.vue')
    },
    {
      path: '/fulfillmentInboundShipment',
      name: 'FulfillmentInboundShipment.Index',
      component: ()=>import('~/pages/mws/fulfillmentInboundShipment/index.vue')
    },
    {
      path: '/fulfillmentInboundShipment/CreateInboundShipmentPlan',
      name: 'FulfillmentInboundShipment.CreateInboundShipmentPlan',
      component: ()=>import('~/pages/mws/fulfillmentInboundShipment/createInboundShipmentPlan.vue')
    },
    // {
    //   path: '/nuxt',
    //   name: 'nuxt.index',
    //   component: ()=>import('~/pages/nuxt/index')
    // },
    // {
    //   path: '/nuxt/create',
    //   name: 'nuxt.create',
    //   component: ()=>import('~/pages/nuxt/create')
    // },
    // {
    //   path: '/nuxt/:id/edit',
    //   name: 'nuxt.edit',
    //   component: ()=>import('~/pages/nuxt/edit')
    // },
    // {
    //   path: '/nuxt/settings',
    //   name: 'nuxt.settings',
    //   component: ()=>import('~/pages/nuxt/settings')
    // },
    // {
    //   path: '/catelog',
    //   name: 'catelog.index',
    //   component: ()=>import('~/pages/catelog/index')
    // },
    // {
    //   path: '/catelog/create',
    //   name: 'catelog.create',
    //   component: ()=>import('~/pages/catelog/create')
    // },
    // {
    //   path: '/catelog/:id/edit',
    //   name: 'catelog.edit',
    //   component: ()=>import('~/pages/catelog/edit')
    // },
    // {
    //   path: '/banner',
    //   name: 'banner.index',
    //   component: ()=>import('~/pages/banner/index')
    // },
    // {
    //   path: '/banner/create',
    //   name: 'banner.create',
    //   component: ()=>import('~/pages/banner/create')
    // },
    // {
    //   path: '/banner/:id/edit',
    //   name: 'banner.edit',
    //   component: ()=>import('~/pages/banner/edit')
    // },
    // {
    //   path: '/settings',
    //   component: ()=>import('~/pages/settings/index.vue'),
    //   children: [
    //     {
    //       path: '',
    //       redirect: {name: 'settings.profile'}
    //     },
    //     {
    //       path: 'profile',
    //       name: 'settings.profile',
    //       component: ()=>import('~/pages/settings/profile.vue')
    //     },
    //     {
    //       path: 'password',
    //       name: 'settings.password',
    //       component: ()=>import('~/pages/settings/password.vue')
    //     }
    //   ]
    // }
  ]),

  // Guest routes.
  ...guestGuard([
    {
      path: '/login',
      name: 'login',
      component: ()=>import('~/pages/auth/login.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: ()=>import('~/pages/auth/register.vue')
    },
    {
      path: '/password/reset',
      name: 'password.request',
      component: ()=>import('~/pages/auth/password/email.vue')
    },
    {
      path: '/password/reset/:token',
      name: 'password.reset',
      component: ()=>import('~/pages/auth/password/reset.vue')
    }
  ]),

  {path: '*', component: ()=>import('~/pages/errors/404.vue')}
]
