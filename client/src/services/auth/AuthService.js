import requestService from '@/services/request-service/ApiRequestService';

const AuthService = {
  async registerUser(registerData) {
    const response = await requestService.post('/auth/register', registerData);

    return response?.data?.data;
  },
  async verifiedEmail(verifiedEmailData) {
    const response = await requestService.post(
      '/auth/verified-email',
      verifiedEmailData
    );

    return response?.data?.data;
  },
  async signIn(userLoginData) {
    const response = await requestService.post('/auth/login', userLoginData);
    this.saveToken(response?.data?.data.accessToken);

    return response?.data?.data;
  },
  async toggleCurrentUserEmailNotification() {
    const response = await requestService.patch(
      '/users/toggle-current-user-email-notification'
    );
    return response?.data?.data;
  },

  async forgotPassword(forgotPasswordData) {
    const response = await requestService.post(
      '/auth/forgot-password',
      forgotPasswordData
    );

    return response?.data?.data;
  },

  async resetPassword(resetPasswordData) {
    const response = await requestService.post(
      '/auth/reset-password',
      resetPasswordData
    );

    return response?.data?.data;
  },

  async signOut() {
    const response = await requestService.post('/auth/logout');
    this.removeToken();
    return response?.data?.data;
  },
  async fetchLoggedUser() {
    const response = await requestService.get('/auth/me');
    return response?.data?.data;
  },
  async changeEmail(data) {
    const response = await requestService.get('/users/change-verify', data);
    return response?.data?.data;
  },
  saveToken(token) {
    localStorage.setItem('auth.accessToken', token);
  },
  removeToken() {
    localStorage.setItem('auth.accessToken', '');
  },
  getToken() {
    return localStorage.getItem('auth.accessToken');
  },
  hasToken() {
    return !!localStorage.getItem('auth.accessToken');
  },

  async signInByProvider(providerName) {
    const response = await requestService.get('/' + providerName + '/auth');

    return response?.data.url;
  },

  async signInByProviderCallback(providerName, data) {
    const response = await requestService.get(
      '/' + providerName + '/callback',
      data
    );
    this.saveToken(response?.data?.data.accessToken);

    return response?.data?.data;
  }
};

export default AuthService;
