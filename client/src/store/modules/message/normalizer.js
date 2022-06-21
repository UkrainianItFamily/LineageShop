import { userMapper } from '@/store/modules/user/normalizer';

export const messagesMapper = function(messages) {
  let result = [];

  result = {
    ...result,
    ...messages.reduce(
      (prev, message) => ({
        ...prev,
        [message.id]: messageMapper(message)
      }),
      {}
    )
  };

  return result;
};

export const messageMapper = message => ({
  id: message.id,
  message: message.message,
  attachment: message.attachment,
  authorUser: userMapper(message.authorUser),
  hiddenStatus: message.hiddenStatus,
  createdAt: message.createdAt
});
