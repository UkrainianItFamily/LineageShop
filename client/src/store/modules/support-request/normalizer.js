export const supportRequestsMapper = function(supportRequests) {
  let result = [];

  result = {
    ...result,
    ...supportRequests.reduce(
      (prev, supportRequest) => ({
        ...prev,
        [supportRequest.id]: supportRequestMapper(supportRequest)
      }),
      {}
    )
  };

  return result;
};
export const supportRequestMapper = item => ({
  id: item.id,
  subject: item.subject,
  authorId: item.authorId,
  login: item.login,
  status: item.status,
  order_id: item.order_id,
  createdAt: item.createdAt,
  updatedAt: item.updatedAt,
  email: item.email
});

export const supportRequestMessagesMapper = function(supportRequestMessages) {
  let result = [];

  result = {
    ...result,
    ...supportRequestMessages.reduce(
      (prev, supportRequestMessage) => ({
        ...prev,
        [supportRequestMessage.id]: supportRequestsMessageMapper(
          supportRequestMessage
        )
      }),
      {}
    )
  };

  return result;
};

export const supportRequestsMessageMapper = item => ({
  id: item.id,
  text: item.text,
  user: item.user,
  createdAt: item.createdAt
});
