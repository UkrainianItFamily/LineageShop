import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from '@/views/Index.vue';
import Auth from '@/views/Auth';
import Registration from '@/views/Registration';
import ForgotPassword from '@/views/ForgotPassword';
import Status from '@/views/Status';
import TradeItem from '@/views/TradeItem';
import TradeAdena from '@/views/TradeAdena';
import Chat from '@/views/Chat';
import ProductDetails from '@/views/ProductDetails';
import EmailVerification from '@/views/EmailVerification';
import authService from '@/services/auth/AuthService';
import UserDataProviderComponent from '@/components/guard/UserDataProviderComponent';
import Finances from '@/views/Finances';
import Error404 from '@/views/Error404';
import ResetPassword from '@/views/ResetPassword';
import MyPurchases from '@/views/MyPurchases';
import MySales from '@/views/MySales';
import UserProfile from '@/views/UserProfile';
import UserSelfProfile from '@/views/UserSelfProfile';
import UserSettings from '@/views/UserSettings';
import ChangePassword from '@/views/ChangePassword';
import SupportRequest from '@/views/SupportRequest';
import UserWallets from '@/views/UserWallets';
import BindEmail from '@/views/BindEmail';
import ConfirmOrder from '@/views/ConfirmOrder';
import AdminPanel from '@/views/AdminPanel';
import UserAdminPanel from '@/views/UserAdminPanel';
import OrderAdminPanel from '@/views/OrderAdminPanel';
import FinanceOperationAdminPanel from '@/views/FinanceOperationAdminPanel';
import SupportAdminPanel from '@/views/SupportAdminPanel';
import SupportChatAdmin from '@/views/SupportChatAdmin';
import SupportRequestTable from '@/views/SupportRequestTable';
import SupportChatComponent from '@/components/support-chat/SupportChatComponent';
import SocialiteAuth from '@/views/SocialiteAuth';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: UserDataProviderComponent,
    children: [
      {
        path: '/auth',
        name: 'Auth',
        component: Auth,
        meta: { handleAuth: true }
      },
      {
        path: '/:provider/callback',
        name: 'Provider',
        component: SocialiteAuth,
        props: true,
        meta: { handleAuth: true }
      },
      {
        path: '/registration',
        name: 'Registration',
        component: Registration,
        meta: { handleAuth: true }
      },
      {
        path: '/email-verification',
        name: 'EmailVerification',
        component: EmailVerification
      },
      {
        path: '/forgot-password',
        name: 'ForgotPassword',
        component: ForgotPassword,
        meta: { handleAuth: true }
      },
      {
        path: '/reset-password',
        name: 'ResetPassword',
        component: ResetPassword,
        meta: { handleAuth: true }
      },
      {
        path: '/status',
        name: 'Status',
        component: Status
      },
      {
        path: '/trade-item',
        name: 'TradeItem',
        component: TradeItem
      },
      {
        path: '/trade-adena',
        name: 'TradeAdena',
        component: TradeAdena
      },
      {
        path: '/chat',
        name: 'Chat',
        component: Chat,
        meta: { requiresAuth: true }
      },
      {
        path: '/chat/:chatId',
        name: 'OpenChat',
        component: Chat,
        meta: { requiresAuth: true }
      },
      {
        path: '/404',
        name: 'Error404',
        component: Error404
      },
      {
        path: '/lots/:id',
        name: 'ProductDetails',
        component: ProductDetails
      },
      {
        path: '/:categoryId/trade',
        name: 'Trade',
        component: TradeItem
      },
      {
        path: '/account/balance',
        name: 'Finances',
        component: Finances
      },
      {
        path: '/orders/purchases',
        name: 'MyPurchases',
        component: MyPurchases
      },
      {
        path: '/orders/sales',
        name: 'MySales',
        component: MySales
      },
      {
        path: '/orders/new/:orderId',
        name: 'ConfirmOrder',
        component: ConfirmOrder,
        meta: { requiresAuth: true }
      },
      {
        path: '/users',
        name: 'UserSelfProfile',
        component: UserSelfProfile
      },
      {
        path: '/users/:id',
        name: 'UserProfile',
        component: UserProfile
      },
      {
        path: '/account/settings',
        name: 'UserSettings',
        component: UserSettings
      },
      {
        path: '/support-requests/',
        name: 'SupportRequestsTable',
        component: SupportRequestTable
      },
      {
        path: '/support-chat/:id',
        name: 'SupportChat',
        component: SupportChatComponent
      },
      {
        path: '/administration',
        name: 'AdminPanel',
        component: AdminPanel,
        meta: { requiresAuth: true },
        children: [
          {
            path: 'users',
            name: 'UserAdminPanel',
            component: UserAdminPanel
          },
          {
            path: 'orders',
            name: 'OrderAdminPanel',
            component: OrderAdminPanel
          },
          {
            path: 'support-messages',
            name: 'SupportAdminPanel',
            component: SupportAdminPanel
          },
          {
            path: 'support-chat/:id',
            name: 'SupportChatAdmin',
            component: SupportChatAdmin
          }
        ]
      },
      {
        path: '/administration/finance-operations',
        name: 'FinanceOperationAdminPanel',
        component: FinanceOperationAdminPanel,
        meta: { requiresAuth: true }
      },
      {
        path: '/account/password',
        name: 'ChangePassword',
        component: ChangePassword
      },
      {
        path: '/requests/new',
        name: 'SupportRequest',
        component: SupportRequest
      },
      {
        path: '/account/wallets',
        name: 'UserWallets',
        component: UserWallets
      },
      {
        path: '/account/email',
        name: 'BindEmail',
        component: BindEmail
      },
      {
        path: '/',
        name: 'Index',
        component: Index,
        children: [
          {
            path: ':categoryId',
            name: 'CategoryOpened'
          }
        ]
      },
      {
        path: '*',
        name: 'NotFoundPageError',
        component: Error404
      }
    ]
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticatedRoute = to.matched.some(
    record => record.meta.requiresAuth
  );
  const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);

  if (isAuthenticatedRoute && !authService.hasToken()) {
    next({ name: 'Auth' });
    return;
  }

  if (isAuthSectionRoute && authService.hasToken()) {
    next({ name: 'UserSelfProfile' });
    return;
  }

  next({ path: to });
});

export default router;
