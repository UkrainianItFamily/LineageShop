import Vue from 'vue';
import Vuex from 'vuex';
import StatusService from './modules/status-service';
import AuthService from './modules/auth';
import Category from './modules/category';
import Product from './modules/product';
import Property from './modules/property';
import Message from './modules/message';
import chat from './modules/chat';
import FinanceOperation from './modules/finance-operation';
import WalletType from './modules/wallet-type';
import UserWallet from './modules/user-wallet';
import notification from './modules/notification';
import order from './modules/order';
import User from './modules/user';
import UserRating from './modules/user-rating';
import SupportRequest from './modules/support-request';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    StatusService,
    AuthService,
    FinanceOperation,
    WalletType,
    UserWallet,
    Category,
    Product,
    Property,
    Message,
    chat,
    notification,
    order,
    User,
    UserRating,
    SupportRequest
  }
});
