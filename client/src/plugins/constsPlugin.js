const CONSTANTS = {
  PROPERTY_TYPE: {
    SELECT: 0,
    BETWEEN_INPUT: 1,
    TEXT_AREA: 2
  },
  FINANCE_OPERATION_TYPE: {
    ENROLLMENT: 1,
    WRITE_OFFS: 2
  },
  FINANCE_OPERATION_STATUS: {
    CREATED: 1,
    EXECUTED: 2,
    PENDING: 3,
    CANCELED: 4
  },
  ORDER_STATUS: {
    CREATED: 1,
    CLOSED: 2,
    CONFIRMED: 3,
    CANCELED: 4
  },
  ORDER_TYPE: {
    PURCHASES: 1,
    SALES: 2
  },
  RATING: {
    MAX: 5
  },
  SUPPORT_REQUEST_STATUS: {
    OPEN: 1,
    CLOSE: 2,
    UNREAD: 3,
    READ: 4
  },
  SUPPORT_REQUEST_CHAT: {
    DEFAULT_USER_PHOTO:
      'https://secure.gravatar.com/avatar/71a8476877076b4204d92b670c4b2979?default=https%3A%2F%2Fassets.zendesk.com%2Fhc%2Fassets%2Fdefault_avatar.png&amp;r=g'
  },
  COMMISSION_PERCENT: 2,
  WALLET_TYPES: {
    QIWI: 1,
    YOOMONEY: 2,
    CARD: 3,
    WEBMONEY_WMZ: 4,
    WEBMONEY_WME: 5,
    BALANCE: 6
  },
  PRODUCT: {
    DEFAULT_AVAILABILITY: 1
  }
};

let Constants = {};

Constants.install = function(Vue) {
  Vue.prototype.$getConst = key => {
    return CONSTANTS[key];
  };
};

export default Constants;
