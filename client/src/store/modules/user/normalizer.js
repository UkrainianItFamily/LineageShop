export const usersMapper = function(users) {
  let result = [];

  result = {
    ...result,
    ...users.reduce(
      (prev, user) => ({
        ...prev,
        [user.id]: userMapper(user)
      }),
      {}
    )
  };

  return result;
};
export const userMapper = user => ({
  id: user.id,
  login: user.login,
  online: user.online,
  email: user.email,
  confirmSendEmail: presentConfirmSendEmail(user.confirmSendEmail),
  userPhoto: user.userPhoto,
  createdAt: user.createdAt,
  onlineStatus: presentUserStatus(user.online)
});

function presentUserStatus(userStatus) {
  if (userStatus) {
    return {
      text: 'Онлайн',
      variant: 'success'
    };
  }
  return {
    text: 'Офлайн',
    variant: 'secondary'
  };
}

function presentConfirmSendEmail(confirmSendEmailStatus) {
  if (confirmSendEmailStatus) {
    return {
      text: 'Отключить',
      variant: 'success'
    };
  }
  return {
    text: 'Включить',
    variant: 'light'
  };
}
