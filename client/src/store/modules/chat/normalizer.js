import { userMapper } from '@/store/modules/user/normalizer';

export const chatsMapper = function(chats) {
  let result = [];

  result = {
    ...result,
    ...chats.reduce(
      (prev, chat) => ({
        ...prev,
        [chat.id]: chatMapper(chat)
      }),
      {}
    )
  };

  return result;
};

export const chatMapper = chat => ({
  id: chat.id ? chat.id : null,
  recipientUser: chat.recipientUser ? userMapper(chat.recipientUser) : null
});
